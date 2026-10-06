@extends('admin.layout')

@section('title', 'Backup & Restore Data')
@section('topbar_title', 'Backup & Restore Data')

@section('content')
<div class="container-fluid px-0" style="max-width: 1100px;">
    
    {{-- Header Banner --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1" style="color:var(--text-dark);">
                <i class="bi bi-database-down me-2" style="color:var(--accent-red);"></i> Backup & Restore Data
            </h3>
            <p class="text-secondary small mb-0">
                Amankan seluruh data company profile Anda dalam <strong>1 file utuh</strong> sebelum maintenance, commit Git, atau pindah ke hosting.
            </p>
        </div>
    </div>

    {{-- Flash Notifications --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-start gap-3 p-3 rounded-3 shadow-sm border-0 mb-4" role="alert" style="background:#ecfdf5; border-left: 5px solid #10b981 !important;">
            <i class="bi bi-check-circle-fill text-success fs-4 mt-0"></i>
            <div class="flex-grow-1">
                <h6 class="fw-bold text-success mb-1">Berhasil!</h6>
                <div class="small text-secondary mb-0">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start gap-3 p-3 rounded-3 shadow-sm border-0 mb-4" role="alert" style="background:#fff1f2; border-left: 5px solid #f43f5e !important;">
            <i class="bi bi-exclamation-triangle-fill text-danger fs-4 mt-0"></i>
            <div class="flex-grow-1">
                <h6 class="fw-bold text-danger mb-1">Terjadi Kesalahan</h6>
                <div class="small text-secondary mb-0">{{ session('error') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- System Status & Overview Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="admin-card p-3 h-100 d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; background: rgba(220, 53, 69, 0.1); color: var(--accent-red);">
                    <i class="bi bi-gear-wide-connected fs-4"></i>
                </div>
                <div>
                    <span class="text-secondary small fw-bold d-block text-uppercase">Pengaturan</span>
                    <h4 class="fw-bold mb-0" style="color:var(--text-dark);">{{ $dbCounts['settings'] ?? 0 }}</h4>
                    <span class="text-muted" style="font-size: 0.72rem;">Slogan, kontak, identitas</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="admin-card p-3 h-100 d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; background: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                    <i class="bi bi-collection fs-4"></i>
                </div>
                <div>
                    <span class="text-secondary small fw-bold d-block text-uppercase">Konten Website</span>
                    <h4 class="fw-bold mb-0" style="color:var(--text-dark);">
                        {{ ($dbCounts['services'] ?? 0) + ($dbCounts['portfolios'] ?? 0) + ($dbCounts['team_members'] ?? 0) + ($dbCounts['philosophies'] ?? 0) }}
                    </h4>
                    <span class="text-muted" style="font-size: 0.72rem;">Layanan, tim, portofolio</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="admin-card p-3 h-100 d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; background: rgba(25, 135, 84, 0.1); color: #198754;">
                    <i class="bi bi-building fs-4"></i>
                </div>
                <div>
                    <span class="text-secondary small fw-bold d-block text-uppercase">Klien & Produk</span>
                    <h4 class="fw-bold mb-0" style="color:var(--text-dark);">
                        {{ ($dbCounts['clients'] ?? 0) }} / {{ ($dbCounts['client_products'] ?? 0) }}
                    </h4>
                    <span class="text-muted" style="font-size: 0.72rem;">Logo & produk klien</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="admin-card p-3 h-100 d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; background: rgba(255, 193, 7, 0.15); color: #b45309;">
                    <i class="bi bi-folder2-open fs-4"></i>
                </div>
                <div>
                    <span class="text-secondary small fw-bold d-block text-uppercase">File Media Upload</span>
                    <h4 class="fw-bold mb-0" style="color:var(--text-dark);">{{ $uploadsFileCount }} File</h4>
                    <span class="text-muted" style="font-size: 0.72rem;">Total ukuran: {{ $uploadsSizeMb }} MB</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Action Cards: Unduh & Upload --}}
    <div class="row g-4">
        
        {{-- CARD 1: UNDUH BACKUP DATA --}}
        <div class="col-lg-6">
            <div class="admin-card h-100 p-4 d-flex flex-column justify-content-between" style="border-top: 4px solid var(--accent-red);">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger px-3 py-1 fw-bold" style="font-size: 0.78rem;">
                            <i class="bi bi-download me-1"></i> LANGKAH 1: UNDUH BACKUP
                        </span>
                        <span class="text-muted small" style="font-size: 0.75rem;">1 File Terpadu</span>
                    </div>

                    <h4 class="h5 fw-bold mb-2" style="color:var(--text-dark);">
                        Unduh Backup Data Sistem
                    </h4>
                    <p class="text-secondary small mb-4">
                        Download seluruh data company profile Anda dalam <strong>1 file kemasan</strong>. Berisi data teks, pengaturan, informasi kontak, profil perusahaan, hingga file gambar/video yang pernah diupload.
                    </p>

                    <div class="p-3 rounded-3 mb-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                        <h6 class="fw-bold small text-dark mb-2">
                            <i class="bi bi-shield-check text-success me-1"></i> Isi yang ada di dalam 1 file backup:
                        </h6>
                        <ul class="list-unstyled mb-0 small text-secondary" style="font-size: 0.82rem; line-height: 1.8;">
                            <li><i class="bi bi-check2 text-danger me-2"></i> <strong>Seluruh Pengaturan Website:</strong> Nama PT, NPWP, alamat, telp, email, slogan & filosofi.</li>
                            <li><i class="bi bi-check2 text-danger me-2"></i> <strong>Semua Layanan (Services):</strong> Judul & deskripsi dwi-bahasa (ID & EN).</li>
                            <li><i class="bi bi-check2 text-danger me-2"></i> <strong>Semua Anggota Tim & Portofolio:</strong> Foto, kutipan, dan deskripsi lengkap.</li>
                            <li><i class="bi bi-check2 text-danger me-2"></i> <strong>Daftar Klien & Foto Produk:</strong> Logo klien dan gambar produk cetak.</li>
                            <li><i class="bi bi-check2 text-danger me-2"></i> <strong>Seluruh Aset Gambar & Video:</strong> Background beranda, background layanan, background tentang kami, logo.</li>
                        </ul>
                    </div>
                </div>

                <div>
                    {{-- Download Button (Full ZIP) --}}
                    <a href="{{ route('admin.backup.download', ['type' => 'full']) }}"
                       class="btn btn-danger w-100 rounded-pill py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 mb-2"
                       style="background: var(--accent-red); border-color: var(--accent-red); font-size: 1rem;">
                        <i class="bi bi-file-earmark-zip-fill fs-5"></i>
                        <span>Unduh Paket Lengkap (ZIP: Data + Media)</span>
                    </a>
                    <div class="text-center mb-3">
                        <small class="text-muted" style="font-size: 0.75rem;">
                            <i class="bi bi-star-fill text-warning me-1"></i> Direkomendasikan untuk backup sebelum maintenance & deployment hosting
                        </small>
                    </div>

                    {{-- Download Button (JSON Only) --}}
                    <div class="pt-2 border-top text-center">
                        <a href="{{ route('admin.backup.download', ['type' => 'json']) }}" class="btn btn-link text-decoration-none btn-sm text-secondary">
                            <i class="bi bi-filetype-json me-1"></i> Unduh Database Saja (Format .json ringkas)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 2: UPLOAD & PULIHKAN DATA --}}
        <div class="col-lg-6">
            <div class="admin-card h-100 p-4 d-flex flex-column justify-content-between" style="border-top: 4px solid #0d6efd;">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary px-3 py-1 fw-bold" style="font-size: 0.78rem;">
                            <i class="bi bi-upload me-1"></i> LANGKAH 2: RESTORE DATA
                        </span>
                        <span class="text-muted small" style="font-size: 0.75rem;">Mendukung .zip & .json</span>
                    </div>

                    <h4 class="h5 fw-bold mb-2" style="color:var(--text-dark);">
                        Upload & Pulihkan Data Backup
                    </h4>
                    <p class="text-secondary small mb-2">
                        Pilih file backup (<strong>.zip</strong> atau <strong>.json</strong>) yang telah diunduh sebelumnya. Sistem akan otomatis mengisi dan menyinkronkan seluruh company profile tanpa Anda harus menginput ulang satu per satu.
                    </p>

                    <div class="p-2.5 px-3 rounded-3 mb-3 d-flex align-items-center gap-2" style="background: #eff6ff; border: 1px solid #bfdbfe; font-size: 0.8rem;">
                        <i class="bi bi-lightning-charge-fill text-primary flex-shrink-0 fs-6"></i>
                        <span class="text-primary-emphasis">
                            <strong>Tips Instan:</strong> Karena file gambar/media sudah ter-pull di hosting dari Git, gunakan file <strong>.json (Database Saja)</strong> agar pemulihan selesai dalam <strong>1 detik</strong> tanpa risiko loading lama!
                        </span>
                    </div>

                    <form action="{{ route('admin.backup.upload') }}" method="POST" enctype="multipart/form-data" id="restoreBackupForm">
                        @csrf

                        {{-- Drag & Drop Upload Box --}}
                        <div class="rounded-3 p-4 text-center mb-3 position-relative"
                             id="backupDropZone"
                             style="border: 2px dashed #cbd5e1; background: #f8fafc; cursor: pointer; transition: all 0.25s ease;"
                             onclick="document.getElementById('backupFileInput').click()"
                             ondragover="event.preventDefault(); this.style.borderColor='#0d6efd'; this.style.background='#eff6ff';"
                             ondragleave="this.style.borderColor='#cbd5e1'; this.style.background='#f8fafc';"
                             ondrop="handleBackupDrop(event)">
                            
                            <div id="dropZonePrompt">
                                <i class="bi bi-cloud-arrow-up fs-1 text-primary d-block mb-2"></i>
                                <h6 class="fw-bold text-dark mb-1">Klik atau Drag & Drop File Backup di Sini</h6>
                                <p class="text-muted small mb-0" style="font-size: 0.78rem;">Mendukung file <strong>.zip</strong> (Paket Lengkap) atau <strong>.json</strong> (Maks. 256MB)</p>
                            </div>

                            {{-- File Selected Preview --}}
                            <div id="fileSelectedBox" class="d-none">
                                <i class="bi bi-file-earmark-check-fill fs-1 text-success d-block mb-1"></i>
                                <h6 class="fw-bold text-dark mb-0" id="selectedFileName">filename.zip</h6>
                                <span class="badge bg-secondary rounded-pill mt-1" id="selectedFileSize">0 MB</span>
                                <p class="small text-primary mt-2 mb-0" style="font-size: 0.78rem;">Klik untuk memilih file lain</p>
                            </div>
                        </div>

                        <input type="file"
                               id="backupFileInput"
                               name="backup_file"
                               accept=".zip,.json,application/zip,application/x-zip-compressed,application/json"
                               class="d-none"
                               onchange="handleBackupFile(this.files[0])"
                               required>

                        {{-- Options --}}
                        <div class="bg-light p-3 rounded-3 mb-3 border">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="keep_current_admin" id="keepAdminCheck" value="1" checked>
                                <label class="form-check-label small fw-semibold text-dark" for="keepAdminCheck">
                                    Pertahankan akun login admin saat ini
                                </label>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">
                                Sangat disarankan agar Anda tidak ter-logout atau terkunci jika password di server asal berbeda.
                            </small>
                        </div>

                        {{-- Warning Alert --}}
                        <div class="alert alert-warning p-2.5 rounded-3 d-flex align-items-center gap-2 mb-3" style="font-size: 0.78rem;">
                            <i class="bi bi-exclamation-triangle-fill text-warning flex-shrink-0 fs-6"></i>
                            <span>Seluruh data company profile saat ini akan diperbarui dan digantikan sesuai isi file backup yang Anda upload.</span>
                        </div>

                        {{-- Submit Button --}}
                        <button type="button"
                                id="btnTriggerRestoreModal"
                                class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2"
                                style="font-size: 1rem;"
                                disabled>
                            <i class="bi bi-arrow-repeat fs-5"></i>
                            <span>Upload & Pulihkan Data Sekarang</span>
                        </button>
                    </form>
                </div>

                <div class="text-center mt-3 pt-2 border-top">
                    <small class="text-muted" style="font-size: 0.72rem;">
                        <i class="bi bi-info-circle me-1"></i> Seluruh cache website akan otomatis dibersihkan setelah restorasi berhasil.
                    </small>
                </div>
            </div>
        </div>
    </div>

    {{-- Explanatory Guide: Maintenance & Hosting Workflow --}}
    <div class="admin-card mt-4 p-4" style="background:#ffffff; border-left: 4px solid #10b981;">
        <h5 class="fw-bold mb-2 text-dark">
            <i class="bi bi-lightbulb-fill text-warning me-2"></i> Panduan Alur Kerja Maintenance & Hosting
        </h5>
        <p class="text-secondary small mb-3">
            Gunakan fitur ini untuk menjaga konsistensi data antara komputer lokal (XAMPP) dan server hosting Anda:
        </p>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="p-3 rounded-3 h-100" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center" style="width:24px; height:24px; font-size:0.75rem;">1</span>
                        <h6 class="fw-bold mb-0 text-dark small">Sebelum Maintenance</h6>
                    </div>
                    <p class="text-muted small mb-0" style="font-size:0.8rem;">
                        Klik tombol <strong>"Unduh Paket Lengkap (ZIP)"</strong> di laptop/komputer Anda untuk mengamankan data dan gambar terbaru ke dalam 1 file simpanan.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 rounded-3 h-100" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center" style="width:24px; height:24px; font-size:0.75rem;">2</span>
                        <h6 class="fw-bold mb-0 text-dark small">Commit & Push ke Git</h6>
                    </div>
                    <p class="text-muted small mb-0" style="font-size:0.8rem;">
                        Lakukan coding, perbaikan fitur, commit, dan push ke Git/server seperti biasa tanpa khawatir data teks dan file media Anda hilang.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 rounded-3 h-100" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center" style="width:24px; height:24px; font-size:0.75rem;">3</span>
                        <h6 class="fw-bold mb-0 text-dark small">Restore di Server Hosting</h6>
                    </div>
                    <p class="text-muted small mb-0" style="font-size:0.8rem;">
                        Buka admin di hosting, upload file backup ZIP tadi. Semua data profil perusahaan, layanan, portofolio, logo, dan foto langsung aktif seketika!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL KONFIRMASI RESTORASI --}}
<div class="modal fade" id="restoreConfirmModal" tabindex="-1" aria-labelledby="restoreConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="restoreConfirmModalLabel">
                    <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
                    Konfirmasi Pemulihan Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <p class="text-secondary small mb-3">
                    Apakah Anda yakin ingin memulihkan data dari file backup:
                    <br><strong class="text-dark fs-6" id="modalFileName">file_backup.zip</strong>
                </p>

                <div class="alert alert-danger py-2 px-3 rounded-3 small mb-0" style="font-size: 0.8rem;">
                    <i class="bi bi-info-circle me-1"></i> <strong>Perhatian:</strong> Data pada database dan folder uploads akan ditimpa/disinkronkan dengan data yang ada pada file backup ini.
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary rounded-pill px-4 fw-bold" id="btnConfirmSubmitRestore">
                    <i class="bi bi-check-lg me-1"></i> Ya, Pulihkan Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

{{-- LOADING OVERLAY SAAT PROSES RESTORE --}}
<div id="restoreLoadingOverlay"
     class="d-none position-fixed top-0 start-0 w-100 h-100 align-items-center justify-content-center"
     style="background: rgba(15, 23, 42, 0.88); backdrop-filter: blur(10px); z-index: 99999;">
    <div class="text-center text-white p-4" style="max-width: 520px; width: 92%;">
        {{-- Spinner --}}
        <div class="spinner-border text-danger mb-3" id="restoreSpinner" style="width: 3.5rem; height: 3.5rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        
        <h4 class="fw-bold mb-2" id="restoreTitle">Sedang Mengunggah File Backup...</h4>
        <p class="text-white-50 small mb-3" id="restoreSubtitle">Harap jangan menutup atau me-refresh halaman ini selama proses berlangsung.</p>

        {{-- Progress Bar --}}
        <div class="progress mb-2 d-none" id="restoreProgressBarContainer" style="height: 12px; background: rgba(255,255,255,0.2); border-radius: 6px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" id="restoreProgressBar" role="progressbar" style="width: 0%"></div>
        </div>
        <div class="d-flex justify-content-between text-white-50 small mb-3 d-none" id="restoreProgressDetails" style="font-size: 0.75rem;">
            <span id="restoreProgressPercent" class="fw-bold text-white">0%</span>
            <span id="restoreProgressBytes">0 MB / 0 MB</span>
        </div>

        {{-- Alert Error jika gagal --}}
        <div class="alert alert-danger text-start d-none py-2 px-3 small rounded-3 mb-3 border-0" id="restoreErrorAlert" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; border-left: 4px solid #ef4444 !important;"></div>

        {{-- Action Buttons --}}
        <div class="mt-2">
            <button type="button" class="btn btn-outline-light rounded-pill px-4 btn-sm d-none fw-bold" id="btnCancelRestoreOverlay">
                <i class="bi bi-x-circle me-1"></i> Tutup & Coba Lagi
            </button>
        </div>
    </div>
</div>

<script>
    function handleBackupFile(file) {
        if (!file) return;

        const btnSubmit = document.getElementById('btnTriggerRestoreModal');
        const promptBox = document.getElementById('dropZonePrompt');
        const previewBox = document.getElementById('fileSelectedBox');
        const nameEl = document.getElementById('selectedFileName');
        const sizeEl = document.getElementById('selectedFileSize');
        const modalFileName = document.getElementById('modalFileName');

        nameEl.textContent = file.name;
        modalFileName.textContent = file.name;
        sizeEl.textContent = (file.size / 1048576).toFixed(2) + ' MB';

        promptBox.classList.add('d-none');
        previewBox.classList.remove('d-none');

        const dropZone = document.getElementById('backupDropZone');
        dropZone.style.borderColor = '#10b981';
        dropZone.style.background = '#f0fdf4';

        btnSubmit.disabled = false;
    }

    function handleBackupDrop(event) {
        event.preventDefault();
        const dropZone = document.getElementById('backupDropZone');
        dropZone.style.borderColor = '#cbd5e1';
        dropZone.style.background = '#f8fafc';

        const file = event.dataTransfer.files[0];
        if (file) {
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('backupFileInput').files = dt.files;
            handleBackupFile(file);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const btnTrigger = document.getElementById('btnTriggerRestoreModal');
        const btnConfirm = document.getElementById('btnConfirmSubmitRestore');
        const restoreModalEl = document.getElementById('restoreConfirmModal');
        const restoreForm = document.getElementById('restoreBackupForm');
        const overlay = document.getElementById('restoreLoadingOverlay');

        const restoreSpinner = document.getElementById('restoreSpinner');
        const restoreTitle = document.getElementById('restoreTitle');
        const restoreSubtitle = document.getElementById('restoreSubtitle');
        const progressBarContainer = document.getElementById('restoreProgressBarContainer');
        const progressBar = document.getElementById('restoreProgressBar');
        const progressDetails = document.getElementById('restoreProgressDetails');
        const progressPercent = document.getElementById('restoreProgressPercent');
        const progressBytes = document.getElementById('restoreProgressBytes');
        const restoreErrorAlert = document.getElementById('restoreErrorAlert');
        const btnCancelOverlay = document.getElementById('btnCancelRestoreOverlay');

        let restoreModal = null;
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            restoreModal = new bootstrap.Modal(restoreModalEl);
        }

        if (btnTrigger) {
            btnTrigger.addEventListener('click', function () {
                if (restoreModal) {
                    restoreModal.show();
                } else if (confirm('Apakah Anda yakin ingin memulihkan data sistem dari file backup ini?')) {
                    executeRestore();
                }
            });
        }

        if (btnConfirm) {
            btnConfirm.addEventListener('click', function () {
                if (restoreModal) {
                    restoreModal.hide();
                }
                executeRestore();
            });
        }

        if (btnCancelOverlay) {
            btnCancelOverlay.addEventListener('click', function () {
                overlay.classList.add('d-none');
                overlay.classList.remove('d-flex');
            });
        }

        function executeRestore() {
            const file = document.getElementById('backupFileInput').files[0];
            if (!file) {
                alert('Pilih file backup terlebih dahulu!');
                return;
            }

            // Tampilkan Overlay & Reset State
            overlay.classList.remove('d-none');
            overlay.classList.add('d-flex');
            restoreSpinner.classList.remove('d-none');
            restoreErrorAlert.classList.add('d-none');
            btnCancelOverlay.classList.add('d-none');
            progressBarContainer.classList.remove('d-none');
            progressDetails.classList.remove('d-none');
            progressBar.style.width = '0%';
            progressPercent.textContent = '0%';
            progressBytes.textContent = '0 MB / ' + (file.size / 1048576).toFixed(2) + ' MB';
            restoreTitle.textContent = 'Sedang Mengunggah File Backup...';
            restoreSubtitle.textContent = 'Mengirim file backup ke server hosting. Harap jangan menutup halaman ini.';

            const formData = new FormData(restoreForm);
            const xhr = new XMLHttpRequest();

            // Progress upload handler
            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percent + '%';
                    progressPercent.textContent = percent + '%';
                    progressBytes.textContent = (e.loaded / 1048576).toFixed(2) + ' MB / ' + (e.total / 1048576).toFixed(2) + ' MB';

                    if (percent >= 100) {
                        restoreTitle.textContent = 'Menyinkronkan Database Sistem...';
                        restoreSubtitle.textContent = 'File terunggah (100%)! Server sedang mengekstrak dan memulihkan seluruh data...';
                        progressBar.classList.add('bg-success');
                        progressBar.classList.remove('bg-danger');
                    }
                }
            };

            // Selesai request
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    let res = null;
                    try {
                        res = JSON.parse(xhr.responseText);
                    } catch(e) {}

                    restoreSpinner.classList.add('d-none');
                    progressBarContainer.classList.add('d-none');
                    progressDetails.classList.add('d-none');
                    restoreTitle.textContent = 'Pemulihan Berhasil!';
                    restoreTitle.style.color = '#34d399';
                    restoreSubtitle.textContent = res && res.message ? res.message : 'Data berhasil dipulihkan secara utuh ke sistem!';

                    setTimeout(function() {
                        window.location.reload();
                    }, 1800);
                } else {
                    handleErrorResponse();
                }
            };

            // Error jaringan
            xhr.onerror = function() {
                handleErrorResponse('Koneksi terputus atau batas waktu (timeout) server hosting terlampaui saat proses upload.');
            };

            // Timeout
            xhr.ontimeout = function() {
                handleErrorResponse('Batas waktu server terlampaui (Timeout). Solusi: Gunakan file backup "Database Saja (.json)" yang sangat ringan (< 1MB) agar instan.');
            };

            function handleErrorResponse(customMsg) {
                restoreSpinner.classList.add('d-none');
                restoreTitle.textContent = 'Gagal Memulihkan Data';
                restoreSubtitle.textContent = 'Terjadi kendala saat proses pengunggahan atau pemulihan data:';
                progressBarContainer.classList.add('d-none');
                progressDetails.classList.add('d-none');
                btnCancelOverlay.classList.remove('d-none');

                let msg = customMsg;
                if (!msg) {
                    try {
                        const res = JSON.parse(xhr.responseText);
                        msg = res.message || 'Terjadi kesalahan pada server hosting.';
                    } catch(e) {
                        if (xhr.status === 413) {
                            msg = 'Ukuran file backup melebihi batas upload PHP server hosting (HTTP 413). Solusi: Silakan unduh dan upload file backup "Database Saja (.json)" yang berukuran sangat kecil.';
                        } else if (xhr.status === 504 || xhr.status === 408) {
                            msg = 'Server mengalami timeout saat memproses file. Solusi: Gunakan file backup "Database Saja (.json)" yang sangat ringan dan instan.';
                        } else {
                            msg = 'Gagal memproses file di server hosting (Kode Status: ' + xhr.status + '). Periksa izin folder uploads atau gunakan format .json.';
                        }
                    }
                }

                restoreErrorAlert.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-1"></i> ' + msg;
                restoreErrorAlert.classList.remove('d-none');
            }

            xhr.open('POST', restoreForm.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.send(formData);
        }
    });
</script>
@endsection
