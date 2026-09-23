<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixPermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically ensure all upload and storage folders exist and have correct write permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing directory permissions for Boutique Profile...');

        $directories = [
            public_path('uploads'),
            public_path('uploads/team'),
            public_path('uploads/philosophy'),
            public_path('uploads/portfolio'),
            public_path('uploads/clients'),
            public_path('uploads/clients/products'),
            storage_path(),
            storage_path('app'),
            storage_path('app/public'),
            storage_path('framework'),
            storage_path('framework/cache'),
            storage_path('framework/cache/data'),
            storage_path('framework/sessions'),
            storage_path('framework/views'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
        ];

        foreach ($directories as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0777, true, true);
                $this->line("Created directory: {$dir}");
            }

            @chmod($dir, 0777);

            // Set permissions on existing files inside
            if (File::isDirectory($dir)) {
                foreach (File::allFiles($dir) as $file) {
                    @chmod($file->getPathname(), 0666);
                }
            }
        }

        // If on Linux/Unix, attempt chown to www-data if running with sudo
        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $webUsers = ['www-data', 'nginx', 'apache'];
            foreach ($webUsers as $user) {
                if (posix_getpwnam($user) !== false) {
                    @chown(public_path('uploads'), $user);
                    @chgrp(public_path('uploads'), $user);
                    @chown(storage_path(), $user);
                    @chgrp(storage_path(), $user);
                    @chown(base_path('bootstrap/cache'), $user);
                    @chgrp(base_path('bootstrap/cache'), $user);
                    
                    // Recursive chown via exec if available
                    @exec("chown -R {$user}:{$user} " . escapeshellarg(public_path('uploads')));
                    @exec("chown -R {$user}:{$user} " . escapeshellarg(storage_path()));
                    @exec("chown -R {$user}:{$user} " . escapeshellarg(base_path('bootstrap/cache')));
                    @exec("chmod -R 775 " . escapeshellarg(public_path('uploads')));
                    @exec("chmod -R 775 " . escapeshellarg(storage_path()));
                    @exec("chmod -R 775 " . escapeshellarg(base_path('bootstrap/cache')));
                    $this->info("Ownership set to web server user: {$user}");
                    break;
                }
            }
        }

        $this->info('Permissions successfully checked and updated!');
        return 0;
    }
}
