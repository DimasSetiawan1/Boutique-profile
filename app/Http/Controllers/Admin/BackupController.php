<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class BackupController extends Controller
{
    /**
     * List of content tables to include in backup and restore.
     */
    protected $tables = [
        'settings',
        'philosophies',
        'services',
        'portfolios',
        'portfolio_images',
        'team_members',
        'clients',
        'client_products',
        'contact_messages',
    ];

    /**
     * Display Backup & Restore dashboard.
     */
    public function index()
    {
        // Calculate storage size of public/uploads
        $uploadsPath = public_path('uploads');
        $uploadsSizeBytes = 0;
        $uploadsFileCount = 0;

        if (File::exists($uploadsPath)) {
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($uploadsPath, RecursiveDirectoryIterator::SKIP_DOTS)
            );
            foreach ($iterator as $file) {
                if ($file->isFile()) {
                    $uploadsSizeBytes += $file->getSize();
                    $uploadsFileCount++;
                }
            }
        }

        $uploadsSizeMb = round($uploadsSizeBytes / 1048576, 2);

        // Gather database counts
        $dbCounts = [];
        foreach ($this->tables as $tbl) {
            try {
                $dbCounts[$tbl] = DB::table($tbl)->count();
            } catch (\Throwable $e) {
                $dbCounts[$tbl] = 0;
            }
        }

        $dbCounts['users'] = DB::table('users')->count();

        return view('admin.backup.index', compact('uploadsSizeMb', 'uploadsFileCount', 'dbCounts'));
    }

    /**
     * Download Backup File (Full ZIP or Database-Only JSON).
     */
    public function downloadBackup(Request $request)
    {
        // Prevent script timeout for large files
        @set_time_limit(300);
        @ini_set('memory_limit', '512M');

        $type = $request->query('type', 'full'); // 'full' (ZIP) or 'json' (Database only)
        $timestamp = date('Y-m-d_His');

        // Compile Database Data
        $databaseData = [];
        $recordCounts = [];

        foreach ($this->tables as $table) {
            try {
                $rows = DB::table($table)->get()->map(function ($row) {
                    return (array) $row;
                })->toArray();
                $databaseData[$table] = $rows;
                $recordCounts[$table] = count($rows);
            } catch (\Throwable $e) {
                $databaseData[$table] = [];
                $recordCounts[$table] = 0;
            }
        }

        // Include users data (admin accounts)
        $users = DB::table('users')->get()->map(function ($u) {
            return (array) $u;
        })->toArray();
        $databaseData['users'] = $users;
        $recordCounts['users'] = count($users);

        $payload = [
            'app_name'     => config('app.name', 'Boutique Design Indonesia'),
            'app_version'  => '1.0.0',
            'created_at'   => date('Y-m-d H:i:s'),
            'backup_type'  => $type,
            'tables_count' => $recordCounts,
            'database'     => $databaseData,
        ];

        // 1. JSON Database Only Export
        if ($type === 'json') {
            $jsonString = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $filename = "boutique_backup_database_{$timestamp}.json";

            return response($jsonString, 200, [
                'Content-Type'        => 'application/json',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
                'Cache-Control'       => 'no-store, no-cache',
            ]);
        }

        // 2. Full Backup Export (ZIP: Database JSON + All Uploads)
        if (!class_exists('ZipArchive')) {
            return back()->with('error', 'Ekstensi PHP ZipArchive tidak aktif pada server ini. Silakan gunakan format "Database Saja (JSON)".');
        }

        $tempDir = storage_path('app/temp_backups');
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0775, true, true);
        }

        $zipFilename = "boutique_backup_full_{$timestamp}.zip";
        $zipFilePath = $tempDir . DIRECTORY_SEPARATOR . $zipFilename;

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return back()->with('error', 'Gagal membuat file arsip ZIP untuk backup.');
        }

        // Add Manifest & Database JSON into ZIP
        $manifest = [
            'app'          => config('app.name', 'Boutique Design Indonesia'),
            'version'      => '1.0.0',
            'created_at'   => date('Y-m-d H:i:s'),
            'type'         => 'full_backup',
            'tables_count' => $recordCounts,
        ];
        $zip->addFromString('manifest.json', json_encode($manifest, JSON_PRETTY_PRINT));
        $zip->addFromString('database.json', json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        // Add public/uploads folder into ZIP recursively
        $uploadsPath = public_path('uploads');
        if (File::exists($uploadsPath)) {
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($uploadsPath, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($iterator as $item) {
                $subPath = substr($item->getPathname(), strlen($uploadsPath) + 1);
                $zipSubPath = 'uploads/' . str_replace('\\', '/', $subPath);

                if ($item->isDir()) {
                    $zip->addEmptyDir($zipSubPath);
                } elseif ($item->isFile()) {
                    $zip->addFile($item->getPathname(), $zipSubPath);
                }
            }
        }

        $zip->close();

        return response()->download($zipFilePath, $zipFilename)->deleteFileAfterSend(true);
    }

    /**
     * Upload & Restore Backup Data (Accepts .zip or .json).
     */
    public function uploadBackup(Request $request)
    {
        @set_time_limit(600);
        @ini_set('memory_limit', '512M');

        $request->validate([
            'backup_file' => 'required|file|max:262144', // up to 256MB
        ], [
            'backup_file.required' => 'Silakan pilih file backup yang ingin diupload.',
            'backup_file.max'      => 'Ukuran file backup melebihi batas maksimal (256MB).',
        ]);

        $file = $request->file('backup_file');
        $ext = strtolower($file->getClientOriginalExtension());
        $keepAdmin = $request->boolean('keep_current_admin', true);

        if (!in_array($ext, ['zip', 'json'])) {
            return back()->with('error', 'Format file tidak didukung! Harap upload file backup dengan format .zip (Paket Lengkap) atau .json (Database).');
        }

        $dbPayload = null;
        $extractedFilesCount = 0;

        // A. Handle ZIP File
        if ($ext === 'zip') {
            if (!class_exists('ZipArchive')) {
                return back()->with('error', 'Server tidak mendukung ekstraksi ZIP (PHP ZipArchive tidak aktif).');
            }

            $zip = new ZipArchive();
            $res = $zip->open($file->getRealPath());
            if ($res !== true) {
                return back()->with('error', 'File ZIP rusak atau tidak dapat dibuka.');
            }

            // Read database.json inside ZIP
            $jsonContent = null;
            $dbCandidates = ['database.json', 'data.json'];
            foreach ($dbCandidates as $candidate) {
                $index = $zip->locateName($candidate, ZipArchive::FL_NODIR);
                if ($index !== false) {
                    $jsonContent = $zip->getFromIndex($index);
                    break;
                }
            }

            if (!$jsonContent) {
                $zip->close();
                return back()->with('error', 'File backup tidak valid: File database.json tidak ditemukan di dalam paket ZIP.');
            }

            $dbPayload = json_decode($jsonContent, true);
            if (!is_array($dbPayload) || !isset($dbPayload['database'])) {
                $zip->close();
                return back()->with('error', 'Struktur data database di dalam file ZIP tidak sesuai atau rusak.');
            }

            // Extract uploads directory safely
            $uploadsDestination = public_path('uploads');
            if (!File::exists($uploadsDestination)) {
                File::makeDirectory($uploadsDestination, 0775, true, true);
            }

            for ($i = 0; $i < $zip->numFiles; $i++) {
                $entryName = $zip->getNameIndex($i);

                // Security check against Zip Slip / path traversal
                if (strpos($entryName, '..') !== false || strpos($entryName, ':') !== false) {
                    continue;
                }

                // We only extract entries that belong to the uploads/ directory
                if (str_starts_with($entryName, 'uploads/')) {
                    $relativeSubPath = substr($entryName, strlen('uploads/'));
                    if (empty($relativeSubPath)) {
                        continue;
                    }

                    $targetPath = $uploadsDestination . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativeSubPath);

                    // If directory
                    if (str_ends_with($entryName, '/')) {
                        if (!File::exists($targetPath)) {
                            File::makeDirectory($targetPath, 0775, true, true);
                        }
                    } else {
                        // File
                        $dir = dirname($targetPath);
                        if (!File::exists($dir)) {
                            File::makeDirectory($dir, 0775, true, true);
                        }

                        $stream = $zip->getStream($entryName);
                        if ($stream) {
                            file_put_contents($targetPath, stream_get_contents($stream));
                            fclose($stream);
                            @chmod($targetPath, 0664);
                            $extractedFilesCount++;
                        }
                    }
                }
            }

            $zip->close();
        }

        // B. Handle JSON File
        if ($ext === 'json') {
            $jsonContent = file_get_contents($file->getRealPath());
            $dbPayload = json_decode($jsonContent, true);

            if (!is_array($dbPayload) || !isset($dbPayload['database'])) {
                return back()->with('error', 'Format file JSON tidak sesuai dengan skema backup Boutique Design Indonesia.');
            }
        }

        // Perform Database Restoration inside Transaction
        $currentAdminUser = Auth::user();
        $restoredStats = [];

        try {
            DB::transaction(function () use ($dbPayload, $keepAdmin, $currentAdminUser, &$restoredStats) {
                // Disable foreign key constraints temporarily
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');

                $database = $dbPayload['database'] ?? [];

                // 1. Restore standard content tables
                foreach ($this->tables as $table) {
                    if (isset($database[$table]) && is_array($database[$table])) {
                        DB::table($table)->truncate();

                        $rows = $database[$table];
                        if (!empty($rows)) {
                            // Insert in chunks of 100 to prevent packet size limits
                            foreach (array_chunk($rows, 100) as $chunk) {
                                DB::table($table)->insert($chunk);
                            }
                        }
                        $restoredStats[$table] = count($rows);
                    }
                }

                // 2. Restore users (Admin)
                if (isset($database['users']) && is_array($database['users'])) {
                    if ($keepAdmin && $currentAdminUser) {
                        // Keep current admin intact, upsert or add others
                        foreach ($database['users'] as $u) {
                            if ($u['email'] === $currentAdminUser->email) {
                                // Keep current password & credentials
                                continue;
                            }
                            DB::table('users')->updateOrInsert(
                                ['email' => $u['email']],
                                [
                                    'name'       => $u['name'] ?? 'Admin',
                                    'password'   => $u['password'],
                                    'created_at' => $u['created_at'] ?? now(),
                                    'updated_at' => $u['updated_at'] ?? now(),
                                ]
                            );
                        }
                    } else {
                        // Replace users table completely
                        DB::table('users')->truncate();
                        foreach (array_chunk($database['users'], 50) as $chunk) {
                            DB::table('users')->insert($chunk);
                        }
                    }
                    $restoredStats['users'] = count($database['users']);
                }

                // Re-enable foreign key constraints
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            });
        } catch (\Throwable $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            Log::error('Backup Restore Failed: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return back()->with('error', 'Gagal memulihkan database: ' . $e->getMessage());
        }

        // Clear views, application cache, and route cache
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
        } catch (\Throwable $e) {}

        // Build nice summary message
        $summary = [];
        if (isset($restoredStats['settings'])) $summary[] = "{$restoredStats['settings']} Pengaturan";
        if (isset($restoredStats['services'])) $summary[] = "{$restoredStats['services']} Layanan";
        if (isset($restoredStats['team_members'])) $summary[] = "{$restoredStats['team_members']} Anggota Tim";
        if (isset($restoredStats['portfolios'])) $summary[] = "{$restoredStats['portfolios']} Portofolio";
        if (isset($restoredStats['portfolio_images'])) $summary[] = "{$restoredStats['portfolio_images']} Foto Portofolio";
        if (isset($restoredStats['philosophies'])) $summary[] = "{$restoredStats['philosophies']} Filosofi";
        if (isset($restoredStats['clients'])) $summary[] = "{$restoredStats['clients']} Klien";
        if (isset($restoredStats['client_products'])) $summary[] = "{$restoredStats['client_products']} Produk Klien";
        if (isset($restoredStats['contact_messages'])) $summary[] = "{$restoredStats['contact_messages']} Pesan Kontak";
        if ($extractedFilesCount > 0) $summary[] = "{$extractedFilesCount} File Foto/Media";

        $summaryText = implode(', ', $summary);

        return back()->with('success', "SELAMAT! Data backup berhasil dipulihkan secara utuh dan sinkron ke sistem! ({$summaryText}). Seluruh company profile kini sudah aktif dengan data yang dipulihkan.");
    }
}
