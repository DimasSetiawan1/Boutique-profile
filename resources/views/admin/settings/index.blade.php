@extends('admin.layout')

@section('title', 'Company Settings')
@section('topbar_title', 'Website Settings')

@section('content')

    {{-- Quick Backup Shortcut Banner --}}
    <div class="alert d-flex align-items-center justify-content-between flex-wrap gap-2 p-3 mb-4 rounded-3 shadow-sm border-0" style="background: linear-gradient(90deg, #1e293b, #0f172a); color: #fff; max-width: 900px;">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background: rgba(220, 53, 69, 0.2); color: var(--accent-red);">
                <i class="bi bi-database-down fs-5"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-0 text-white">Amankan Data Sebelum Maintenance</h6>
                <small class="text-white-50">Unduh seluruh data company profile & aset foto ke dalam 1 file backup sebelum maintenance atau deploy ke hosting.</small>
            </div>
        </div>
        <a href="{{ route('admin.backup.index') }}" class="btn btn-danger btn-sm rounded-pill px-3 py-2 fw-semibold flex-shrink-0" style="background: var(--accent-red); border-color: var(--accent-red);">
            <i class="bi bi-cloud-arrow-down me-1"></i> Buka Backup & Restore
        </a>
    </div>

    {{-- ===================== LOGO MANAGEMENT ===================== --}}
    <div class="admin-card mb-4" style="max-width: 900px;">
        <h4 class="h5 fw-bold mb-1" style="color:var(--text-dark);">
            <i class="bi bi-image me-2" style="color:var(--accent-red);"></i>Logo Management
        </h4>
        <p class="text-secondary small mb-4">Upload logo baru untuk mengganti logo yang tampil di navbar, footer, dan sidebar admin.</p>

        @if(session('logo_success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('logo_success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('logo_error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ session('logo_error') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @error('logo')
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $message }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @enderror

        <div class="row g-4 align-items-start">
            {{-- Current Logo Preview --}}
            <div class="col-md-5">
                <p class="small fw-bold text-secondary mb-2">Logo Saat Ini</p>
                <div class="d-flex align-items-center justify-content-center rounded-3 p-4"
                     style="background: linear-gradient(135deg,#1a1a2e,#16213e); min-height:120px; border:1px solid rgba(255,255,255,.08);">
                    <img id="currentLogo"
                         src="{{ asset('uploads/logo.png') }}?t={{ time() }}"
                         alt="Logo Saat Ini"
                         style="max-height:70px; width:auto; filter:brightness(0) invert(1);"
                         onerror="this.src='{{ asset('uploads/logo.png') }}'">
                </div>
                <p class="text-muted" style="font-size:.75rem; margin-top:.4rem;">Tampilan di dark background (navbar/footer/sidebar)</p>
            </div>

            {{-- Upload Form --}}
            <div class="col-md-7">
                <p class="small fw-bold text-secondary mb-2">Upload Logo Baru</p>

                {{-- Live Preview Box --}}
                <div id="logoPreviewBox"
                     class="d-none align-items-center justify-content-center rounded-3 p-3 mb-3"
                     style="background:#f8f9fa; border:2px dashed #dee2e6; min-height:100px;">
                    <img id="logoPreviewImg" src="#" alt="Preview" style="max-height:70px; width:auto;">
                </div>

                <form action="{{ route('admin.settings.logo') }}" method="POST" enctype="multipart/form-data" id="logoUploadForm">
                    @csrf
                    <div class="logo-drop-zone rounded-3 p-4 text-center mb-3"
                         id="logoDropZone"
                         style="border:2px dashed #dee2e6; cursor:pointer; transition:border-color .2s, background .2s;"
                         onclick="document.getElementById('logoFileInput').click()"
                         ondragover="event.preventDefault(); this.style.borderColor='var(--accent-red)'; this.style.background='#fff5f5';"
                         ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                         ondrop="handleLogoDrop(event)">
                        <i class="bi bi-cloud-arrow-up fs-2 text-secondary"></i>
                        <p class="mb-0 small text-secondary mt-1">Klik atau drag & drop file logo ke sini</p>
                        <p class="mb-0" style="font-size:.72rem; color:#adb5bd;">PNG, JPG, GIF — maks. 4MB</p>
                        <p id="logoFileName" class="mb-0 mt-2 small fw-semibold" style="color:var(--accent-red); display:none;"></p>
                    </div>
                    <input type="file" id="logoFileInput" name="logo" accept="image/png,image/jpeg,image/gif" class="d-none" onchange="handleLogoFile(this.files[0])">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-600"
                                style="background:var(--accent-red); border-color:var(--accent-red);"
                                id="logoUploadBtn" disabled>
                            <i class="bi bi-upload me-1"></i> Upload & Simpan Logo
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2"
                                onclick="resetLogoForm()">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== HERO / BERANDA BACKGROUND MEDIA ===================== --}}
    <div class="admin-card mb-4" style="max-width: 900px;" id="heroBackgroundCard">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
            <h4 class="h5 fw-bold mb-0" style="color:var(--text-dark);">
                <i class="bi bi-display me-2" style="color:var(--accent-red);"></i>Background Beranda / Hero (Gambar & Video)
            </h4>
            @php
                $activeBgType = $settings['hero_bg_type'] ?? 'image';
                $curBgImg = !empty($settings['hero_bg_image']) ? $settings['hero_bg_image'] : 'uploads/hero-bg.png';
                $curBgVid = $settings['hero_bg_video'] ?? '';
                $curBgVidUrl = $settings['hero_bg_video_url'] ?? '';
                $hasCustomVideo = (!empty($curBgVid) && file_exists(public_path($curBgVid))) || !empty($curBgVidUrl);
                $curOpacity = isset($settings['hero_overlay_opacity']) ? (int)$settings['hero_overlay_opacity'] : 82;
                $curColorMode = $settings['hero_overlay_color'] ?? 'light';
            @endphp
            <div>
                @if($activeBgType === 'video' && $hasCustomVideo)
                    <span class="badge rounded-pill bg-primary px-3 py-2" style="font-size:0.8rem;">
                        <i class="bi bi-camera-video-fill me-1"></i> Mode Aktif: VIDEO
                    </span>
                @elseif($activeBgType === 'default')
                    <span class="badge rounded-pill bg-secondary px-3 py-2" style="font-size:0.8rem;">
                        <i class="bi bi-circle me-1"></i> Mode Aktif: STANDAR
                    </span>
                @else
                    <span class="badge rounded-pill bg-success px-3 py-2" style="font-size:0.8rem;">
                        <i class="bi bi-image-fill me-1"></i> Mode Aktif: GAMBAR
                    </span>
                @endif
            </div>
        </div>
        <p class="text-secondary small mb-4">Ganti media latar belakang pada halaman Beranda utama company profile. Anda dapat mengunggah gambar resolusi tinggi atau file video berputar otomatis (HTML5 Background Video), serta menyesuaikan transparansi dan warna overlay.</p>

        @if(session('hero_media_success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('hero_media_success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('hero_media_error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ session('hero_media_error') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @error('hero_image')
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $message }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @enderror
        @error('hero_video')
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $message }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @enderror

        <div class="row g-4 align-items-start">
            {{-- Current Media Preview --}}
            <div class="col-md-5">
                <p class="small fw-bold text-secondary mb-2">Tampilan Media Saat Ini</p>
                
                <div class="rounded-3 p-2 overflow-hidden position-relative shadow-sm"
                     style="background: #1e293b; min-height: 190px; border: 1px solid #cbd5e1; display:flex; align-items:center; justify-content:center;">
                    
                    @if($activeBgType === 'video' && $hasCustomVideo)
                        {{-- Video Preview --}}
                        <div class="w-100 text-center">
                            <video controls muted autoplay loop playsinline class="w-100 rounded" style="max-height: 220px; object-fit: cover;">
                                @if(!empty($curBgVid) && file_exists(public_path($curBgVid)))
                                    <source src="{{ asset($curBgVid) }}" type="video/mp4">
                                @elseif(!empty($curBgVidUrl))
                                    <source src="{{ $curBgVidUrl }}">
                                @endif
                                Browser Anda tidak mendukung video HTML5.
                            </video>
                            <div class="text-white-50 small mt-1" style="font-size:0.75rem;">
                                <i class="bi bi-camera-video me-1"></i> Background Video Aktif
                            </div>
                        </div>
                    @else
                        {{-- Image Preview --}}
                        <div class="w-100 text-center">
                            @if(file_exists(public_path($curBgImg)))
                                <img src="{{ asset($curBgImg) }}?t={{ time() }}"
                                     alt="Background Beranda"
                                     class="rounded img-fluid w-100"
                                     style="max-height: 210px; object-fit: cover;">
                            @else
                                <img src="{{ asset('uploads/hero-bg.png') }}?t={{ time() }}"
                                     alt="Background Beranda Default"
                                     class="rounded img-fluid w-100"
                                     style="max-height: 210px; object-fit: cover;">
                            @endif
                            <div class="text-white-50 small mt-1" style="font-size:0.75rem;">
                                <i class="bi bi-image me-1"></i> Background Gambar Aktif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Action / Reset Button --}}
                <div class="d-flex flex-column gap-2 mt-3">
                    <form action="{{ route('admin.settings.hero_media.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset background beranda ke gambar default?')">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary w-100 rounded-pill py-2">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset ke Gambar Default
                        </button>
                    </form>

                    @if(!empty($curBgVid) && file_exists(public_path($curBgVid)))
                        <form action="{{ route('admin.settings.hero_media.delete_video') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file video ini dari server?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill py-2">
                                <i class="bi bi-trash me-1"></i> Hapus File Video
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Upload & Edit Form --}}
            <div class="col-md-7">
                <form action="{{ route('admin.settings.hero_media') }}" method="POST" enctype="multipart/form-data" id="heroMediaForm">
                    @csrf

                    {{-- Background Type Selector (Radio Pills) --}}
                    <label class="small fw-bold text-secondary mb-2 d-block">Pilih Format Background</label>
                    <div class="btn-group w-100 mb-3" role="group">
                        <input type="radio" class="btn-check" name="hero_bg_type" id="typeImage" value="image" autocomplete="off" {{ $activeBgType === 'image' ? 'checked' : '' }} onchange="toggleHeroMediaType('image')">
                        <label class="btn btn-outline-danger py-2" for="typeImage"><i class="bi bi-image me-1"></i> Gambar (Image)</label>

                        <input type="radio" class="btn-check" name="hero_bg_type" id="typeVideo" value="video" autocomplete="off" {{ $activeBgType === 'video' ? 'checked' : '' }} onchange="toggleHeroMediaType('video')">
                        <label class="btn btn-outline-danger py-2" for="typeVideo"><i class="bi bi-camera-video me-1"></i> Video (MP4)</label>

                        <input type="radio" class="btn-check" name="hero_bg_type" id="typeDefault" value="default" autocomplete="off" {{ $activeBgType === 'default' ? 'checked' : '' }} onchange="toggleHeroMediaType('default')">
                        <label class="btn btn-outline-danger py-2" for="typeDefault"><i class="bi bi-circle me-1"></i> Standar</label>
                    </div>

                    {{-- Image Upload Section --}}
                    <div id="heroImageSection" class="{{ $activeBgType === 'video' ? 'd-none' : '' }}">
                        <p class="small fw-bold text-secondary mb-1">Upload Gambar Baru</p>

                        {{-- Instant Preview Box for Image --}}
                        <div id="heroImagePreviewBox"
                             class="d-none align-items-center justify-content-center rounded-3 p-2 mb-2 text-center"
                             style="background:#f8f9fa; border:2px dashed #dee2e6;">
                            <img id="heroImagePreviewImg" src="#" alt="Preview" class="rounded img-fluid" style="max-height:160px; width:auto;">
                        </div>

                        <div class="rounded-3 p-3 text-center mb-3"
                             id="heroImageDropZone"
                             style="border:2px dashed #dee2e6; cursor:pointer; transition:border-color .2s, background .2s;"
                             onclick="document.getElementById('heroImageFileInput').click()"
                             ondragover="event.preventDefault(); this.style.borderColor='var(--accent-red)'; this.style.background='#fff5f5';"
                             ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                             ondrop="handleHeroImageDrop(event)">
                            <i class="bi bi-file-earmark-image fs-3 text-secondary"></i>
                            <p class="mb-0 small text-secondary mt-1">Klik atau drag & drop file foto/gambar di sini</p>
                            <p class="mb-0" style="font-size:.72rem; color:#adb5bd;">JPG, PNG, WEBP, GIF — Rasio rekomendasi 16:9 (maks 15MB)</p>
                            <p id="heroImageFileName" class="mb-0 mt-2 small fw-semibold" style="color:var(--accent-red); display:none;"></p>
                        </div>
                        <input type="file" id="heroImageFileInput" name="hero_image" accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml" class="d-none" onchange="handleHeroImageFile(this.files[0])">
                    </div>

                    {{-- Video Upload Section --}}
                    <div id="heroVideoSection" class="{{ $activeBgType === 'video' ? '' : 'd-none' }}">
                        <p class="small fw-bold text-secondary mb-1">Upload Video Baru (Maks 40MB)</p>

                        {{-- Instant Preview Player for Video --}}
                        <div id="heroVideoPreviewBox"
                             class="d-none align-items-center justify-content-center rounded-3 p-2 mb-2 text-center"
                             style="background:#0f172a; border:2px dashed #475569;">
                            <video id="heroVideoPreviewPlayer" controls class="w-100 rounded" style="max-height:160px; object-fit:cover;"></video>
                        </div>

                        <div class="rounded-3 p-3 text-center mb-3"
                             id="heroVideoDropZone"
                             style="border:2px dashed #dee2e6; cursor:pointer; transition:border-color .2s, background .2s;"
                             onclick="document.getElementById('heroVideoFileInput').click()"
                             ondragover="event.preventDefault(); this.style.borderColor='var(--accent-red)'; this.style.background='#fff5f5';"
                             ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                             ondrop="handleHeroVideoDrop(event)">
                            <i class="bi bi-file-earmark-play fs-3 text-secondary"></i>
                            <p class="mb-0 small text-secondary mt-1">Klik atau drag & drop file video di sini</p>
                            <p class="mb-0" style="font-size:.72rem; color:#adb5bd;">MP4, WebM, OGG, MOV — maks. 40MB</p>
                            <p id="heroVideoFileName" class="mb-0 mt-2 small fw-semibold" style="color:var(--accent-red); display:none;"></p>
                        </div>
                        <input type="file" id="heroVideoFileInput" name="hero_video" accept="video/mp4,video/webm,video/ogg,video/quicktime" class="d-none" onchange="handleHeroVideoFile(this.files[0])">

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">Atau Gunakan Direct Video URL (Opsional)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                <input type="url" name="hero_video_url" class="form-control" placeholder="https://example.com/video.mp4" value="{{ $curBgVidUrl }}">
                            </div>
                            <small class="text-muted" style="font-size:0.72rem;">Gunakan jika file video Anda di-host di Cloud Storage / CDN / server lain.</small>
                        </div>
                    </div>

                    {{-- Overlay Styling Controls --}}
                    <div class="border-top pt-3 mt-3">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label small fw-bold text-secondary mb-1">Nuansa Overlay</label>
                                <select name="hero_overlay_color" class="form-select form-select-sm">
                                    <option value="light" {{ $curColorMode === 'light' ? 'selected' : '' }}>☀️ Terang (Cream Glass - Teks Gelap)</option>
                                    <option value="dark" {{ $curColorMode === 'dark' ? 'selected' : '' }}>🌙 Gelap (Dark Slate - Teks Putih Kontras)</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label small fw-bold text-secondary mb-0">Kepekatan Overlay</label>
                                    <span id="opacityDisplay" class="badge bg-light text-dark border">{{ $curOpacity }}%</span>
                                </div>
                                <input type="range" class="form-range" name="hero_overlay_opacity" min="0" max="100" value="{{ $curOpacity }}" oninput="document.getElementById('opacityDisplay').textContent = this.value + '%'">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-600"
                                style="background:var(--accent-red); border-color:var(--accent-red);">
                            <i class="bi bi-cloud-arrow-up me-1"></i> Simpan Background Beranda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== PHILOSOPHY SECTION IMAGE ===================== --}}
    <div class="admin-card mb-4" style="max-width: 900px;">
        <h4 class="h5 fw-bold mb-1" style="color:var(--text-dark);">
            <i class="bi bi-lightbulb me-2" style="color:var(--accent-red);"></i>Philosophy Section Image (Gambar Filosofi)
        </h4>
        <p class="text-secondary small mb-4">Upload gambar atau ilustrasi khusus untuk bagian Filosofi & Mindset pada company profile. Jika tidak diupload, sistem akan menampilkan diagram otak standar (SVG interaktif).</p>

        @if(session('philosophy_success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('philosophy_success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @error('philosophy_image')
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $message }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @enderror

        <div class="row g-4 align-items-start">
            {{-- Current Image Preview --}}
            <div class="col-md-5">
                <p class="small fw-bold text-secondary mb-2">Gambar Saat Ini</p>
                <div class="d-flex flex-column align-items-center justify-content-center rounded-3 p-3 text-center"
                     style="background: #f8f9fa; min-height:160px; border:1px solid #dee2e6;">
                    @if(!empty($settings['philosophy_image']) && file_exists(public_path($settings['philosophy_image'])))
                        <img src="{{ asset($settings['philosophy_image']) }}?t={{ time() }}"
                             alt="Gambar Filosofi"
                             class="rounded shadow-sm img-fluid mb-2"
                             style="max-height:140px; width:auto; object-fit:contain;">
                        <form action="{{ route('admin.settings.philosophy_image.delete') }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini dan kembali ke diagram otak standar?')">
                                <i class="bi bi-trash me-1"></i>Hapus (Gunakan Diagram)
                            </button>
                        </form>
                    @else
                        <div class="text-muted p-2">
                            <i class="bi bi-diagram-3 fs-1 text-secondary mb-1"></i>
                            <div class="small fw-bold text-dark">Diagram Otak Standar (SVG Aktif)</div>
                            <div style="font-size:0.75rem;">Belum ada gambar kustom diupload.</div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Upload Form --}}
            <div class="col-md-7">
                <p class="small fw-bold text-secondary mb-2">Upload Gambar Filosofi Baru</p>

                {{-- Live Preview Box --}}
                <div id="philoPreviewBox"
                     class="d-none align-items-center justify-content-center rounded-3 p-3 mb-3"
                     style="background:#f8f9fa; border:2px dashed #dee2e6; min-height:120px;">
                    <img id="philoPreviewImg" src="#" alt="Preview" style="max-height:120px; width:auto; object-fit:contain;" class="rounded">
                </div>

                <form action="{{ route('admin.settings.philosophy_image') }}" method="POST" enctype="multipart/form-data" id="philoUploadForm">
                    @csrf
                    <div class="philo-drop-zone rounded-3 p-4 text-center mb-3"
                         id="philoDropZone"
                         style="border:2px dashed #dee2e6; cursor:pointer; transition:border-color .2s, background .2s;"
                         onclick="document.getElementById('philoFileInput').click()"
                         ondragover="event.preventDefault(); this.style.borderColor='var(--accent-red)'; this.style.background='#fff5f5';"
                         ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                         ondrop="handlePhiloDrop(event)">
                        <i class="bi bi-cloud-arrow-up fs-2 text-secondary"></i>
                        <p class="mb-0 small text-secondary mt-1">Klik atau drag & drop file gambar ke sini</p>
                        <p class="mb-0" style="font-size:.72rem; color:#adb5bd;">PNG, JPG, JPEG, WEBP, SVG, GIF — maks. 8MB</p>
                        <p id="philoFileName" class="mb-0 mt-2 small fw-semibold" style="color:var(--accent-red); display:none;"></p>
                    </div>
                    <input type="file" id="philoFileInput" name="philosophy_image" accept="image/*" class="d-none" onchange="handlePhiloFile(this.files[0])">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-600"
                                style="background:var(--accent-red); border-color:var(--accent-red);"
                                id="philoUploadBtn" disabled>
                            <i class="bi bi-upload me-1"></i> Upload & Simpan Gambar
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2"
                                onclick="resetPhiloForm()">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== SERVICES SECTION BACKGROUND ===================== --}}
    <div class="admin-card mb-4" style="max-width: 900px;" id="servicesBackgroundCard">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
            <h4 class="h5 fw-bold mb-0" style="color:var(--text-dark);">
                <i class="bi bi-printer me-2" style="color:var(--accent-red);"></i>Background Layanan / Services (Gambar & Video)
            </h4>
            @php
                $activeServicesBgType = $settings['services_bg_type'] ?? 'image';
                $curServicesImg = !empty($settings['services_bg_image']) ? $settings['services_bg_image'] : 'uploads/services-bg.jpg';
                $curServicesVid = $settings['services_bg_video'] ?? '';
                $curServicesVidUrl = $settings['services_bg_video_url'] ?? '';
                $hasCustomServicesVideo = (!empty($curServicesVid) && file_exists(public_path($curServicesVid))) || !empty($curServicesVidUrl);
                $curServicesOpacity = isset($settings['services_overlay_opacity']) ? (int)$settings['services_overlay_opacity'] : 85;
                $curServicesColorMode = $settings['services_overlay_color'] ?? 'light';
            @endphp
            <div>
                @if($activeServicesBgType === 'video' && $hasCustomServicesVideo)
                    <span class="badge rounded-pill bg-primary px-3 py-2" style="font-size:0.8rem;">
                        <i class="bi bi-camera-video-fill me-1"></i> Mode Aktif: VIDEO
                    </span>
                @elseif($activeServicesBgType === 'default')
                    <span class="badge rounded-pill bg-secondary px-3 py-2" style="font-size:0.8rem;">
                        <i class="bi bi-circle me-1"></i> Mode Aktif: STANDAR
                    </span>
                @else
                    <span class="badge rounded-pill bg-success px-3 py-2" style="font-size:0.8rem;">
                        <i class="bi bi-image-fill me-1"></i> Mode Aktif: GAMBAR
                    </span>
                @endif
            </div>
        </div>
        <p class="text-secondary small mb-4">Ganti media latar belakang pada bagian Layanan (Services) company profile. Anda dapat mengunggah gambar resolusi tinggi atau video berputar otomatis (HTML5 Background Video) dengan nuansa overlay.</p>

        @if(session('services_media_success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('services_media_success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('services_media_error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ session('services_media_error') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @error('services_image')
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $message }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @enderror
        @error('services_video')
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $message }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @enderror

        <div class="row g-4 align-items-start">
            {{-- Current Media Preview --}}
            <div class="col-md-5">
                <p class="small fw-bold text-secondary mb-2">Tampilan Media Saat Ini</p>
                <div class="rounded-3 p-2 overflow-hidden position-relative shadow-sm"
                     style="background: #1e293b; min-height:190px; border:1px solid #cbd5e1; display:flex; align-items:center; justify-content:center;">
                    
                    @if($activeServicesBgType === 'video' && $hasCustomServicesVideo)
                        {{-- Video Preview --}}
                        <div class="w-100 text-center">
                            <video controls muted autoplay loop playsinline class="w-100 rounded" style="max-height: 220px; object-fit: cover;">
                                @if(!empty($curServicesVid) && file_exists(public_path($curServicesVid)))
                                    <source src="{{ asset($curServicesVid) }}" type="video/mp4">
                                @elseif(!empty($curServicesVidUrl))
                                    <source src="{{ $curServicesVidUrl }}">
                                @endif
                                Browser Anda tidak mendukung video HTML5.
                            </video>
                            <div class="text-white-50 small mt-1" style="font-size:0.75rem;">
                                <i class="bi bi-camera-video me-1"></i> Background Video Layanan Aktif
                            </div>
                        </div>
                    @else
                        {{-- Image Preview --}}
                        <div class="w-100 text-center">
                            @if(file_exists(public_path($curServicesImg)))
                                <img src="{{ asset($curServicesImg) }}?t={{ time() }}"
                                     alt="Background Layanan"
                                     class="rounded img-fluid w-100"
                                     style="max-height:210px; object-fit:cover;">
                            @else
                                <img src="{{ asset('uploads/services-bg.jpg') }}?t={{ time() }}"
                                     alt="Background Layanan Default"
                                     class="rounded img-fluid w-100"
                                     style="max-height:210px; object-fit:cover;">
                            @endif
                            <div class="text-white-50 small mt-1" style="font-size:0.75rem;">
                                <i class="bi bi-image me-1"></i> Background Gambar Layanan Aktif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Action / Reset Button --}}
                <div class="d-flex flex-column gap-2 mt-3">
                    <form action="{{ route('admin.settings.services_media.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset background layanan ke gambar default percetakan?')">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary w-100 rounded-pill py-2">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset ke Gambar Default
                        </button>
                    </form>

                    @if(!empty($curServicesVid) && file_exists(public_path($curServicesVid)))
                        <form action="{{ route('admin.settings.services_media.delete_video') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file video background layanan ini dari server?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill py-2">
                                <i class="bi bi-trash me-1"></i> Hapus File Video Layanan
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Upload & Edit Form --}}
            <div class="col-md-7">
                <form action="{{ route('admin.settings.services_media') }}" method="POST" enctype="multipart/form-data" id="servicesMediaForm">
                    @csrf

                    {{-- Background Type Selector (Radio Pills) --}}
                    <label class="small fw-bold text-secondary mb-2 d-block">Pilih Format Background Layanan</label>
                    <div class="btn-group w-100 mb-3" role="group">
                        <input type="radio" class="btn-check" name="services_bg_type" id="typeServicesImage" value="image" autocomplete="off" {{ $activeServicesBgType === 'image' ? 'checked' : '' }} onchange="toggleServicesMediaType('image')">
                        <label class="btn btn-outline-danger py-2" for="typeServicesImage"><i class="bi bi-image me-1"></i> Gambar (Image)</label>

                        <input type="radio" class="btn-check" name="services_bg_type" id="typeServicesVideo" value="video" autocomplete="off" {{ $activeServicesBgType === 'video' ? 'checked' : '' }} onchange="toggleServicesMediaType('video')">
                        <label class="btn btn-outline-danger py-2" for="typeServicesVideo"><i class="bi bi-camera-video me-1"></i> Video (MP4)</label>

                        <input type="radio" class="btn-check" name="services_bg_type" id="typeServicesDefault" value="default" autocomplete="off" {{ $activeServicesBgType === 'default' ? 'checked' : '' }} onchange="toggleServicesMediaType('default')">
                        <label class="btn btn-outline-danger py-2" for="typeServicesDefault"><i class="bi bi-circle me-1"></i> Standar</label>
                    </div>

                    {{-- Image Upload Section --}}
                    <div id="servicesImageSection" class="{{ $activeServicesBgType === 'video' ? 'd-none' : '' }}">
                        <p class="small fw-bold text-secondary mb-1">Upload Gambar Baru</p>

                        {{-- Instant Preview Box for Image --}}
                        <div id="servicesImagePreviewBox"
                             class="d-none align-items-center justify-content-center rounded-3 p-2 mb-2 text-center"
                             style="background:#f8f9fa; border:2px dashed #dee2e6;">
                            <img id="servicesImagePreviewImg" src="#" alt="Preview" class="rounded img-fluid" style="max-height:160px; width:auto;">
                        </div>

                        <div class="rounded-3 p-3 text-center mb-3"
                             id="servicesImageDropZone"
                             style="border:2px dashed #dee2e6; cursor:pointer; transition:border-color .2s, background .2s;"
                             onclick="document.getElementById('servicesImageFileInput').click()"
                             ondragover="event.preventDefault(); this.style.borderColor='var(--accent-red)'; this.style.background='#fff5f5';"
                             ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                             ondrop="handleServicesImageDrop(event)">
                            <i class="bi bi-file-earmark-image fs-3 text-secondary"></i>
                            <p class="mb-0 small text-secondary mt-1">Klik atau drag & drop file foto/gambar di sini</p>
                            <p class="mb-0" style="font-size:.72rem; color:#adb5bd;">JPG, PNG, WEBP, GIF — Rasio rekomendasi 16:9 (maks 15MB)</p>
                            <p id="servicesImageFileName" class="mb-0 mt-2 small fw-semibold" style="color:var(--accent-red); display:none;"></p>
                        </div>
                        <input type="file" id="servicesImageFileInput" name="services_image" accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml" class="d-none" onchange="handleServicesImageFile(this.files[0])">
                    </div>

                    {{-- Video Upload Section --}}
                    <div id="servicesVideoSection" class="{{ $activeServicesBgType === 'video' ? '' : 'd-none' }}">
                        <p class="small fw-bold text-secondary mb-1">Upload Video Baru (Maks 40MB)</p>

                        {{-- Instant Preview Player for Video --}}
                        <div id="servicesVideoPreviewBox"
                             class="d-none align-items-center justify-content-center rounded-3 p-2 mb-2 text-center"
                             style="background:#0f172a; border:2px dashed #475569;">
                            <video id="servicesVideoPreviewPlayer" controls class="w-100 rounded" style="max-height:160px; object-fit:cover;"></video>
                        </div>

                        <div class="rounded-3 p-3 text-center mb-3"
                             id="servicesVideoDropZone"
                             style="border:2px dashed #dee2e6; cursor:pointer; transition:border-color .2s, background .2s;"
                             onclick="document.getElementById('servicesVideoFileInput').click()"
                             ondragover="event.preventDefault(); this.style.borderColor='var(--accent-red)'; this.style.background='#fff5f5';"
                             ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                             ondrop="handleServicesVideoDrop(event)">
                            <i class="bi bi-file-earmark-play fs-3 text-secondary"></i>
                            <p class="mb-0 small text-secondary mt-1">Klik atau drag & drop file video di sini</p>
                            <p class="mb-0" style="font-size:.72rem; color:#adb5bd;">MP4, WebM, OGG, MOV — maks. 40MB</p>
                            <p id="servicesVideoFileName" class="mb-0 mt-2 small fw-semibold" style="color:var(--accent-red); display:none;"></p>
                        </div>
                        <input type="file" id="servicesVideoFileInput" name="services_video" accept="video/mp4,video/webm,video/ogg,video/quicktime" class="d-none" onchange="handleServicesVideoFile(this.files[0])">

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">Atau Gunakan Direct Video URL (Opsional)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                <input type="url" name="services_video_url" class="form-control" placeholder="https://example.com/video.mp4" value="{{ $curServicesVidUrl }}">
                            </div>
                            <small class="text-muted" style="font-size:0.72rem;">Gunakan jika file video Anda di-host di Cloud Storage / CDN / server lain.</small>
                        </div>
                    </div>

                    {{-- Overlay Styling Controls --}}
                    <div class="border-top pt-3 mt-3">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label small fw-bold text-secondary mb-1">Nuansa Overlay</label>
                                <select name="services_overlay_color" class="form-select form-select-sm">
                                    <option value="light" {{ $curServicesColorMode === 'light' ? 'selected' : '' }}>☀️ Terang (Frosted Glass - Teks Gelap)</option>
                                    <option value="dark" {{ $curServicesColorMode === 'dark' ? 'selected' : '' }}>🌙 Gelap (Dark Slate - Teks Putih Kontras)</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label small fw-bold text-secondary mb-0">Kepekatan Overlay</label>
                                    <span id="servicesOpacityDisplay" class="badge bg-light text-dark border">{{ $curServicesOpacity }}%</span>
                                </div>
                                <input type="range" class="form-range" name="services_overlay_opacity" min="0" max="100" value="{{ $curServicesOpacity }}" oninput="document.getElementById('servicesOpacityDisplay').textContent = this.value + '%'">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-600"
                                style="background:var(--accent-red); border-color:var(--accent-red);">
                            <i class="bi bi-cloud-arrow-up me-1"></i> Simpan Background Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== ABOUT (TENTANG KAMI) BACKGROUND MEDIA ===================== --}}
    @php
        $activeAboutBgType = $settings['about_bg_type'] ?? 'image';
        $curAboutImg       = !empty($settings['about_bg_image']) ? $settings['about_bg_image'] : 'uploads/about-bg.jpg';
        $curAboutVid       = $settings['about_bg_video'] ?? '';
        $curAboutVidUrl    = $settings['about_bg_video_url'] ?? '';
        $curAboutOp        = isset($settings['about_overlay_opacity']) ? (int)$settings['about_overlay_opacity'] : 88;
        $curAboutColor     = $settings['about_overlay_color'] ?? 'light';
    @endphp

    <div class="admin-card mb-4" style="max-width: 900px; border-left: 4px solid var(--accent-red);">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h4 class="h5 fw-bold mb-1" style="color:var(--text-dark);">
                    <i class="bi bi-file-earmark-person me-2 text-danger"></i> Background Bagian "Tentang Kami" (What Are We)
                </h4>
                <p class="text-muted small mb-0">Atur background pada section Tentang Kami (What Are We / Tentang Kami). Anda dapat menggunakan gambar beresolusi tinggi, video looping MP4, atau mereset ke gambar standar percetakan.</p>
            </div>
            <div>
                @if($activeAboutBgType === 'video')
                    <span class="badge rounded-pill bg-success-subtle text-success border border-success px-3 py-2">
                        <i class="bi bi-camera-video me-1"></i> Mode Video Aktif
                    </span>
                @else
                    <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary px-3 py-2">
                        <i class="bi bi-image me-1"></i> Mode Gambar Aktif
                    </span>
                @endif
            </div>
        </div>

        @if(session('about_media_success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('about_media_success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('about_media_error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ session('about_media_error') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4 align-items-start">
            {{-- Preview Area --}}
            <div class="col-md-5">
                <label class="small fw-bold text-secondary mb-2 d-block">Preview Background Saat Ini</label>
                <div class="rounded-3 border overflow-hidden p-2 position-relative bg-dark d-flex align-items-center justify-content-center"
                     style="min-height: 220px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
                    @if($activeAboutBgType === 'video' && (!empty($curAboutVid) || !empty($curAboutVidUrl)))
                        {{-- Video Preview --}}
                        <div class="w-100 text-center">
                            <video class="w-100 rounded" controls muted loop style="max-height: 210px; object-fit: cover;">
                                @if(!empty($curAboutVid) && file_exists(public_path($curAboutVid)))
                                    <source src="{{ asset($curAboutVid) }}" type="video/mp4">
                                @elseif(!empty($curAboutVidUrl))
                                    <source src="{{ $curAboutVidUrl }}">
                                @endif
                                Browser Anda tidak mendukung video HTML5.
                            </video>
                            <div class="text-white-50 small mt-1" style="font-size:0.75rem;">
                                <i class="bi bi-camera-video me-1"></i> Background Video Tentang Kami Aktif
                            </div>
                        </div>
                    @else
                        {{-- Image Preview --}}
                        <div class="w-100 text-center">
                            @if(file_exists(public_path($curAboutImg)))
                                <img src="{{ asset($curAboutImg) }}?t={{ time() }}"
                                     alt="Background Tentang Kami"
                                     class="rounded img-fluid w-100"
                                     style="max-height:210px; object-fit:cover;">
                            @else
                                <img src="{{ asset('uploads/about-bg.jpg') }}?t={{ time() }}"
                                     alt="Background Tentang Kami Default"
                                     class="rounded img-fluid w-100"
                                     style="max-height:210px; object-fit:cover;">
                            @endif
                            <div class="text-white-50 small mt-1" style="font-size:0.75rem;">
                                <i class="bi bi-image me-1"></i> Background Gambar Tentang Kami Aktif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Action / Reset Button --}}
                <div class="d-flex flex-column gap-2 mt-3">
                    <form action="{{ route('admin.settings.about_media.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset background Tentang Kami ke gambar default percetakan?')">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary w-100 rounded-pill py-2">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset ke Gambar Default
                        </button>
                    </form>

                    @if(!empty($curAboutVid) && file_exists(public_path($curAboutVid)))
                        <form action="{{ route('admin.settings.about_media.delete_video') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file video background Tentang Kami ini dari server?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill py-2">
                                <i class="bi bi-trash me-1"></i> Hapus File Video Tentang Kami
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Upload & Edit Form --}}
            <div class="col-md-7">
                <form action="{{ route('admin.settings.about_media') }}" method="POST" enctype="multipart/form-data" id="aboutMediaForm">
                    @csrf

                    {{-- Background Type Selector (Radio Pills) --}}
                    <label class="small fw-bold text-secondary mb-2 d-block">Pilih Format Background Tentang Kami</label>
                    <div class="btn-group w-100 mb-3" role="group">
                        <input type="radio" class="btn-check" name="about_bg_type" id="typeAboutImage" value="image" autocomplete="off" {{ $activeAboutBgType === 'image' ? 'checked' : '' }} onchange="toggleAboutMediaType('image')">
                        <label class="btn btn-outline-danger py-2" for="typeAboutImage"><i class="bi bi-image me-1"></i> Gambar (Image)</label>

                        <input type="radio" class="btn-check" name="about_bg_type" id="typeAboutVideo" value="video" autocomplete="off" {{ $activeAboutBgType === 'video' ? 'checked' : '' }} onchange="toggleAboutMediaType('video')">
                        <label class="btn btn-outline-danger py-2" for="typeAboutVideo"><i class="bi bi-camera-video me-1"></i> Video (MP4)</label>

                        <input type="radio" class="btn-check" name="about_bg_type" id="typeAboutDefault" value="default" autocomplete="off" {{ $activeAboutBgType === 'default' ? 'checked' : '' }} onchange="toggleAboutMediaType('default')">
                        <label class="btn btn-outline-danger py-2" for="typeAboutDefault"><i class="bi bi-circle me-1"></i> Standar</label>
                    </div>

                    {{-- Image Upload Section --}}
                    <div id="aboutImageSection" class="{{ $activeAboutBgType === 'video' ? 'd-none' : '' }}">
                        <p class="small fw-bold text-secondary mb-1">Upload Gambar Baru</p>

                        {{-- Instant Preview Box for Image --}}
                        <div id="aboutImagePreviewBox"
                             class="d-none align-items-center justify-content-center rounded-3 p-2 mb-2 text-center"
                             style="background:#f8f9fa; border:2px dashed #dee2e6;">
                            <img id="aboutImagePreviewImg" src="#" alt="Preview" class="rounded img-fluid" style="max-height:160px; width:auto;">
                        </div>

                        <div class="rounded-3 p-3 text-center mb-3"
                             id="aboutImageDropZone"
                             style="border:2px dashed #dee2e6; cursor:pointer; transition:border-color .2s, background .2s;"
                             onclick="document.getElementById('aboutImageFileInput').click()"
                             ondragover="event.preventDefault(); this.style.borderColor='var(--accent-red)'; this.style.background='#fff5f5';"
                             ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                             ondrop="handleAboutImageDrop(event)">
                            <i class="bi bi-file-earmark-image fs-3 text-secondary"></i>
                            <p class="mb-0 small text-secondary mt-1">Klik atau drag & drop file foto/gambar di sini</p>
                            <p class="mb-0" style="font-size:.72rem; color:#adb5bd;">JPG, PNG, WEBP, GIF — Rasio rekomendasi 16:9 (maks 15MB)</p>
                            <p id="aboutImageFileName" class="mb-0 mt-2 small fw-semibold" style="color:var(--accent-red); display:none;"></p>
                        </div>
                        <input type="file" id="aboutImageFileInput" name="about_image" accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml" class="d-none" onchange="handleAboutImageFile(this.files[0])">
                    </div>

                    {{-- Video Upload Section --}}
                    <div id="aboutVideoSection" class="{{ $activeAboutBgType === 'video' ? '' : 'd-none' }}">
                        <p class="small fw-bold text-secondary mb-1">Upload Video Baru (Maks 40MB)</p>

                        {{-- Instant Preview Player for Video --}}
                        <div id="aboutVideoPreviewBox"
                             class="d-none align-items-center justify-content-center rounded-3 p-2 mb-2 text-center"
                             style="background:#0f172a; border:2px dashed #475569;">
                            <video id="aboutVideoPreviewPlayer" controls class="w-100 rounded" style="max-height:160px; object-fit:cover;"></video>
                        </div>

                        <div class="rounded-3 p-3 text-center mb-3"
                             id="aboutVideoDropZone"
                             style="border:2px dashed #dee2e6; cursor:pointer; transition:border-color .2s, background .2s;"
                             onclick="document.getElementById('aboutVideoFileInput').click()"
                             ondragover="event.preventDefault(); this.style.borderColor='var(--accent-red)'; this.style.background='#fff5f5';"
                             ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                             ondrop="handleAboutVideoDrop(event)">
                            <i class="bi bi-file-earmark-play fs-3 text-secondary"></i>
                            <p class="mb-0 small text-secondary mt-1">Klik atau drag & drop file video di sini</p>
                            <p class="mb-0" style="font-size:.72rem; color:#adb5bd;">MP4, WebM, OGG, MOV — maks. 40MB</p>
                            <p id="aboutVideoFileName" class="mb-0 mt-2 small fw-semibold" style="color:var(--accent-red); display:none;"></p>
                        </div>
                        <input type="file" id="aboutVideoFileInput" name="about_video" accept="video/mp4,video/webm,video/ogg,video/quicktime" class="d-none" onchange="handleAboutVideoFile(this.files[0])">

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">Atau Gunakan Direct Video URL (Opsional)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                <input type="url" name="about_video_url" class="form-control" placeholder="https://example.com/video.mp4" value="{{ $curAboutVidUrl }}">
                            </div>
                            <small class="text-muted" style="font-size:0.72rem;">Gunakan jika file video Anda di-host di Cloud Storage / CDN / server lain.</small>
                        </div>
                    </div>

                    {{-- Overlay Styling Controls --}}
                    <div class="bg-light p-3 rounded-3 mb-3 border">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="aboutOverlayRange" class="form-label small fw-bold text-secondary mb-0">Tingkat Transparansi / Overlay Opacity</label>
                            <span id="aboutOverlayValBadge" class="badge bg-secondary">{{ $curAboutOp }}%</span>
                        </div>
                        <p class="text-muted mb-2" style="font-size:0.75rem;">Tingkatkan opacity (80% - 92%) agar teks dan grafik diagram strategi tetap kontras dan mudah dibaca.</p>
                        <input type="range" class="form-range" min="30" max="98" step="1" id="aboutOverlayRange" name="about_overlay_opacity" value="{{ $curAboutOp }}" oninput="document.getElementById('aboutOverlayValBadge').textContent = this.value + '%'">

                        <div class="mt-2 pt-2 border-top">
                            <label class="form-label small fw-bold text-secondary mb-1 d-block">Nuansa Warna Overlay (Theme Tone)</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="about_overlay_color" id="aboutColorLight" value="light" {{ $curAboutColor === 'light' ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="aboutColorLight">
                                        <i class="bi bi-sun me-1 text-warning"></i> Terang (Light Soft White)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="about_overlay_color" id="aboutColorDark" value="dark" {{ $curAboutColor === 'dark' ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="aboutColorDark">
                                        <i class="bi bi-moon-stars me-1 text-primary"></i> Gelap (Modern Dark Navy)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger px-4 rounded-pill">
                            <i class="bi bi-cloud-arrow-up me-1"></i> Simpan Background Tentang Kami
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== COMPANY SETTINGS ===================== --}}
    <div class="admin-card" style="max-width: 900px;">
        <h4 class="h5 fw-bold mb-4" style="color:var(--text-dark);">Update Company Settings</h4>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <h5 class="fw-bold mb-3 pb-2 border-bottom text-danger" style="font-size: 1.1rem; color:var(--accent-red) !important;"><i class="bi bi-info-circle me-1"></i> Basic Company Information</h5>
            
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="company_name" class="form-label small fw-bold text-secondary">Company Name *</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $settings['company_name'] ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="npwp" class="form-label small fw-bold text-secondary">NPWP Registration Number *</label>
                    <input type="text" class="form-control" id="npwp" name="npwp" value="{{ old('npwp', $settings['npwp'] ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label small fw-bold text-secondary">Office Phone Number *</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    @php
                        $rawEmailsJson = $settings['company_emails'] ?? null;
                        $savedEmails = !empty($rawEmailsJson) ? json_decode($rawEmailsJson, true) : null;
                        if (!is_array($savedEmails) || empty($savedEmails)) {
                            $savedEmails = !empty($settings['email']) ? [$settings['email']] : ['info@boutiquedesign.com'];
                        }
                    @endphp
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label small fw-bold text-secondary mb-0">
                            Office Email Address <span class="text-danger">*</span>
                        </label>
                        <button type="button" id="btnAddEmail" onclick="addNewEmailRow()" class="btn btn-outline-danger btn-sm rounded-pill py-0 px-2.5" style="font-size: 0.78rem;">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Email
                        </button>
                    </div>

                    <div id="emailsContainer" class="d-flex flex-column gap-2">
                        @foreach($savedEmails as $index => $emailVal)
                            <div class="input-group email-row">
                                <span class="input-group-text bg-light text-muted">
                                    <i class="bi bi-envelope-fill text-danger"></i>
                                </span>
                                <input type="email" 
                                       class="form-control input-office-email" 
                                       name="emails[]" 
                                       value="{{ $emailVal }}" 
                                       placeholder="contoh: info@boutiquedesign.com" 
                                       required>
                                <button type="button" 
                                        class="btn btn-outline-danger btn-delete-email" 
                                        onclick="deleteEmailRow(this)"
                                        title="Hapus email ini" 
                                        {{ count($savedEmails) <= 1 ? 'disabled style=opacity:0.4;' : '' }}>
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <small class="text-muted d-block mt-1" style="font-size:0.73rem;">
                        <i class="bi bi-info-circle me-1"></i> Klik <strong>Tambah Email</strong> untuk menambahkan alamat email baru, atau <strong>Hapus</strong> untuk menghapus email yang dipilih.
                    </small>
                </div>
                <div class="col-12">
                    <label for="address" class="form-label small fw-bold text-secondary">Office Address *</label>
                    <textarea class="form-control" id="address" name="address" rows="2" required>{{ old('address', $settings['address'] ?? '') }}</textarea>
                </div>
            </div>

            <h5 class="fw-bold mb-3 pb-2 border-bottom text-danger" style="font-size: 1.1rem; color:var(--accent-red) !important;"><i class="bi bi-chat-quote me-1"></i> Website Slogans & Philosophy</h5>
            
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="slogan_main_en" class="form-label small fw-bold text-secondary">Main Hero Slogan (English) *</label>
                    <textarea class="form-control" id="slogan_main_en" name="slogan_main_en" rows="2" required>{{ old('slogan_main_en', $settings['slogan_main_en'] ?? '') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="slogan_main_id" class="form-label small fw-bold text-secondary">Main Hero Slogan (Indonesian) *</label>
                    <textarea class="form-control" id="slogan_main_id" name="slogan_main_id" rows="2" required>{{ old('slogan_main_id', $settings['slogan_main_id'] ?? '') }}</textarea>
                </div>
                
                <div class="col-md-6">
                    <label for="slogan_sub_en" class="form-label small fw-bold text-secondary">Sub Hero Slogan (English) *</label>
                    <input type="text" class="form-control" id="slogan_sub_en" name="slogan_sub_en" value="{{ old('slogan_sub_en', $settings['slogan_sub_en'] ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="slogan_sub_id" class="form-label small fw-bold text-secondary">Sub Hero Slogan (Indonesian) *</label>
                    <input type="text" class="form-control" id="slogan_sub_id" name="slogan_sub_id" value="{{ old('slogan_sub_id', $settings['slogan_sub_id'] ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="slogan_philosophy_en" class="form-label small fw-bold text-secondary">Philosophy Slogan (English) *</label>
                    <input type="text" class="form-control" id="slogan_philosophy_en" name="slogan_philosophy_en" value="{{ old('slogan_philosophy_en', $settings['slogan_philosophy_en'] ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="slogan_philosophy_id" class="form-label small fw-bold text-secondary">Philosophy Slogan (Indonesian) *</label>
                    <input type="text" class="form-control" id="slogan_philosophy_id" name="slogan_philosophy_id" value="{{ old('slogan_philosophy_id', $settings['slogan_philosophy_id'] ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="philosophy_desc_en" class="form-label small fw-bold text-secondary">Philosophy Detailed Text (English)</label>
                    <textarea class="form-control" id="philosophy_desc_en" name="philosophy_desc_en" rows="3">{{ old('philosophy_desc_en', $settings['philosophy_desc_en'] ?? __('messages.philosophy.desc', [], 'en')) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="philosophy_desc_id" class="form-label small fw-bold text-secondary">Philosophy Detailed Text (Indonesian)</label>
                    <textarea class="form-control" id="philosophy_desc_id" name="philosophy_desc_id" rows="3">{{ old('philosophy_desc_id', $settings['philosophy_desc_id'] ?? __('messages.philosophy.desc', [], 'id')) }}</textarea>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1 text-danger" style="font-size: 1.15rem; color:var(--accent-red) !important;">
                        <i class="bi bi-person-lines-fill me-2"></i> Direct Contacts (Contact Persons)
                    </h5>
                    <p class="text-muted small mb-0">Kelola daftar kontak person (CP) untuk konsultasi WhatsApp langsung di website. Anda dapat menambah, mengedit, atau menghapus kontak sesuai kebutuhan.</p>
                </div>
                <div class="mt-2 mt-md-0 d-flex flex-wrap align-items-center gap-2">
                    <span id="contacts-save-indicator" class="small text-success fw-bold d-none">
                        <i class="bi bi-check-circle-fill me-1"></i> Tersimpan!
                    </span>
                    <button type="button" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm d-flex align-items-center gap-1" id="btnSaveContacts">
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                        <span>Simpan Kontak</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm d-flex align-items-center gap-1" id="btnAddContact" style="background-color: var(--accent-red); border-color: var(--accent-red);">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Tambah Kontak</span>
                    </button>
                </div>
            </div>

            @php
                $rawJson = $settings['direct_contacts'] ?? null;
                $existingContacts = ($rawJson !== null) ? json_decode($rawJson, true) : null;
                if (!is_array($existingContacts)) {
                    $existingContacts = [];
                    for ($i = 1; $i <= 4; $i++) {
                        $n = trim((string)($settings["contact_person_{$i}_name"] ?? ''));
                        $p = trim((string)($settings["contact_person_{$i}_phone"] ?? ''));
                        if (!empty($n) || !empty($p)) {
                            $existingContacts[] = ['name' => $n, 'phone' => $p];
                        }
                    }
                }
            @endphp

            <div id="contactsContainer" class="mb-4">
                @foreach($existingContacts as $index => $cp)
                    <div class="contact-card p-3 mb-3 border rounded-3 bg-white shadow-sm position-relative" data-index="{{ $index }}" style="border-left: 4px solid var(--accent-red) !important; transition: all 0.25s ease;">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge rounded-pill px-2.5 py-1 contact-badge" style="background-color: var(--accent-red); font-size: 0.78rem;">
                                    <i class="bi bi-person-badge me-1"></i> Kontak #{{ $loop->iteration }}
                                </span>
                                <span class="small fw-bold text-dark contact-preview-title">{{ $cp['name'] ?? 'Kontak Baru' }}</span>
                            </div>
                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1 btn-delete-contact" title="Hapus kontak ini">
                                <i class="bi bi-trash3-fill me-1"></i> Hapus
                            </button>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary mb-1">Nama / Jabatan CP <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-person-fill text-danger"></i></span>
                                    <input type="text" class="form-control input-cp-name" name="contact_persons[{{ $index }}][name]" value="{{ $cp['name'] ?? '' }}" placeholder="Contoh: (Direktur) Enung Kosasih" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary mb-1">Nomor Telepon / WhatsApp <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-success"><i class="bi bi-whatsapp"></i></span>
                                    <input type="text" class="form-control input-cp-phone" name="contact_persons[{{ $index }}][phone]" value="{{ $cp['phone'] ?? '' }}" placeholder="Contoh: 0856 9317 4242" required>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="emptyContactsAlert" class="alert alert-secondary text-center py-4 mb-4 {{ count($existingContacts) > 0 ? 'd-none' : '' }}" style="border-radius: 12px; border-style: dashed;">
                <i class="bi bi-person-x fs-2 text-muted d-block mb-2"></i>
                <p class="mb-2 fw-semibold text-secondary">Belum ada kontak person.</p>
                <button type="button" class="btn btn-sm btn-danger rounded-pill px-4" onclick="document.getElementById('btnAddContact').click()" style="background-color: var(--accent-red); border-color: var(--accent-red);">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Kontak Sekarang
                </button>
            </div>

            <div class="d-flex gap-3 pt-3 border-top">
                <button type="submit" class="btn btn-danger rounded-pill px-5 py-2" style="background-color:var(--accent-red); border-color:var(--accent-red); font-weight:600;">
                    Save All Settings
                </button>
            </div>
        </form>
    </div>

    {{-- Upload Scripts --}}
    <script>
        // Logo Upload JS
        function handleLogoFile(file) {
            if (!file) return;
            const nameEl = document.getElementById('logoFileName');
            nameEl.textContent = file.name;
            nameEl.style.display = 'block';

            const reader = new FileReader();
            reader.onload = function(e) {
                const box = document.getElementById('logoPreviewBox');
                const img = document.getElementById('logoPreviewImg');
                img.src = e.target.result;
                box.classList.remove('d-none');
                box.classList.add('d-flex');
            };
            reader.readAsDataURL(file);

            document.getElementById('logoUploadBtn').disabled = false;
            const dz = document.getElementById('logoDropZone');
            dz.style.borderColor = 'var(--accent-red)';
            dz.style.background  = '#fff5f5';
        }

        function handleLogoDrop(event) {
            event.preventDefault();
            const dz = document.getElementById('logoDropZone');
            dz.style.borderColor = '#dee2e6';
            dz.style.background  = '';
            const file = event.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('logoFileInput').files = dt.files;
                handleLogoFile(file);
            }
        }

        function resetLogoForm() {
            document.getElementById('logoFileInput').value = '';
            document.getElementById('logoPreviewBox').classList.add('d-none');
            document.getElementById('logoPreviewBox').classList.remove('d-flex');
            document.getElementById('logoPreviewImg').src = '#';
            document.getElementById('logoFileName').style.display = 'none';
            document.getElementById('logoUploadBtn').disabled = true;
            const dz = document.getElementById('logoDropZone');
            dz.style.borderColor = '#dee2e6';
            dz.style.background  = '';
        }

        // Philosophy Image Upload JS
        function handlePhiloFile(file) {
            if (!file) return;
            const nameEl = document.getElementById('philoFileName');
            nameEl.textContent = file.name;
            nameEl.style.display = 'block';

            const reader = new FileReader();
            reader.onload = function(e) {
                const box = document.getElementById('philoPreviewBox');
                const img = document.getElementById('philoPreviewImg');
                img.src = e.target.result;
                box.classList.remove('d-none');
                box.classList.add('d-flex');
            };
            reader.readAsDataURL(file);

            document.getElementById('philoUploadBtn').disabled = false;
            const dz = document.getElementById('philoDropZone');
            dz.style.borderColor = 'var(--accent-red)';
            dz.style.background  = '#fff5f5';
        }

        function handlePhiloDrop(event) {
            event.preventDefault();
            const dz = document.getElementById('philoDropZone');
            dz.style.borderColor = '#dee2e6';
            dz.style.background  = '';
            const file = event.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('philoFileInput').files = dt.files;
                handlePhiloFile(file);
            }
        }

        function resetPhiloForm() {
            document.getElementById('philoFileInput').value = '';
            document.getElementById('philoPreviewBox').classList.add('d-none');
            document.getElementById('philoPreviewBox').classList.remove('d-flex');
            document.getElementById('philoPreviewImg').src = '#';
            document.getElementById('philoFileName').style.display = 'none';
            document.getElementById('philoUploadBtn').disabled = true;
            const dz = document.getElementById('philoDropZone');
            dz.style.borderColor = '#dee2e6';
            dz.style.background  = '';
        }

        // ==========================================
        // Services Background Media (Gambar & Video) JS
        // ==========================================
        function toggleServicesMediaType(type) {
            const imgSec = document.getElementById('servicesImageSection');
            const vidSec = document.getElementById('servicesVideoSection');
            if (type === 'video') {
                imgSec.classList.add('d-none');
                vidSec.classList.remove('d-none');
            } else if (type === 'image') {
                imgSec.classList.remove('d-none');
                vidSec.classList.add('d-none');
            } else {
                imgSec.classList.add('d-none');
                vidSec.classList.add('d-none');
            }
        }

        function handleServicesImageFile(file) {
            if (!file) return;
            const nameEl = document.getElementById('servicesImageFileName');
            nameEl.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
            nameEl.style.display = 'block';

            const reader = new FileReader();
            reader.onload = function(e) {
                const box = document.getElementById('servicesImagePreviewBox');
                const img = document.getElementById('servicesImagePreviewImg');
                img.src = e.target.result;
                box.classList.remove('d-none');
                box.classList.add('d-flex');
            };
            reader.readAsDataURL(file);

            const dz = document.getElementById('servicesImageDropZone');
            dz.style.borderColor = 'var(--accent-red)';
            dz.style.background  = '#fff5f5';
        }

        function handleServicesImageDrop(event) {
            event.preventDefault();
            const dz = document.getElementById('servicesImageDropZone');
            dz.style.borderColor = '#dee2e6';
            dz.style.background  = '';
            const file = event.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('servicesImageFileInput').files = dt.files;
                handleServicesImageFile(file);
            }
        }

        function handleServicesVideoFile(file) {
            if (!file) return;
            const nameEl = document.getElementById('servicesVideoFileName');
            nameEl.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
            nameEl.style.display = 'block';

            const box = document.getElementById('servicesVideoPreviewBox');
            const player = document.getElementById('servicesVideoPreviewPlayer');
            player.src = URL.createObjectURL(file);
            box.classList.remove('d-none');
            box.classList.add('d-flex');

            const dz = document.getElementById('servicesVideoDropZone');
            dz.style.borderColor = 'var(--accent-red)';
            dz.style.background  = '#fff5f5';
        }

        function handleServicesVideoDrop(event) {
            event.preventDefault();
            const dz = document.getElementById('servicesVideoDropZone');
            dz.style.borderColor = '#dee2e6';
            dz.style.background  = '';
            const file = event.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('servicesVideoFileInput').files = dt.files;
                handleServicesVideoFile(file);
            }
        }

        // ==========================================
        // About (Tentang Kami) Background Media JS
        // ==========================================
        function toggleAboutMediaType(type) {
            const imgSec = document.getElementById('aboutImageSection');
            const vidSec = document.getElementById('aboutVideoSection');
            if (type === 'video') {
                imgSec.classList.add('d-none');
                vidSec.classList.remove('d-none');
            } else if (type === 'image') {
                imgSec.classList.remove('d-none');
                vidSec.classList.add('d-none');
            } else {
                imgSec.classList.add('d-none');
                vidSec.classList.add('d-none');
            }
        }

        function handleAboutImageFile(file) {
            if (!file) return;
            const nameEl = document.getElementById('aboutImageFileName');
            nameEl.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
            nameEl.style.display = 'block';

            const reader = new FileReader();
            reader.onload = function(e) {
                const box = document.getElementById('aboutImagePreviewBox');
                const img = document.getElementById('aboutImagePreviewImg');
                img.src = e.target.result;
                box.classList.remove('d-none');
                box.classList.add('d-flex');
            };
            reader.readAsDataURL(file);

            const dz = document.getElementById('aboutImageDropZone');
            dz.style.borderColor = 'var(--accent-red)';
            dz.style.background  = '#fff5f5';
        }

        function handleAboutImageDrop(event) {
            event.preventDefault();
            const dz = document.getElementById('aboutImageDropZone');
            dz.style.borderColor = '#dee2e6';
            dz.style.background  = '';
            const file = event.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('aboutImageFileInput').files = dt.files;
                handleAboutImageFile(file);
            }
        }

        function handleAboutVideoFile(file) {
            if (!file) return;
            const nameEl = document.getElementById('aboutVideoFileName');
            nameEl.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
            nameEl.style.display = 'block';

            const box = document.getElementById('aboutVideoPreviewBox');
            const player = document.getElementById('aboutVideoPreviewPlayer');
            player.src = URL.createObjectURL(file);
            box.classList.remove('d-none');
            box.classList.add('d-flex');

            const dz = document.getElementById('aboutVideoDropZone');
            dz.style.borderColor = 'var(--accent-red)';
            dz.style.background  = '#fff5f5';
        }

        function handleAboutVideoDrop(event) {
            event.preventDefault();
            const dz = document.getElementById('aboutVideoDropZone');
            dz.style.borderColor = '#dee2e6';
            dz.style.background  = '';
            const file = event.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('aboutVideoFileInput').files = dt.files;
                handleAboutVideoFile(file);
            }
        }

        // ==========================================
        // Hero Background Media (Gambar & Video) JS
        // ==========================================
        function toggleHeroMediaType(type) {
            const imgSec = document.getElementById('heroImageSection');
            const vidSec = document.getElementById('heroVideoSection');
            if (type === 'video') {
                imgSec.classList.add('d-none');
                vidSec.classList.remove('d-none');
            } else if (type === 'image') {
                imgSec.classList.remove('d-none');
                vidSec.classList.add('d-none');
            } else {
                imgSec.classList.add('d-none');
                vidSec.classList.add('d-none');
            }
        }

        function handleHeroImageFile(file) {
            if (!file) return;
            const nameEl = document.getElementById('heroImageFileName');
            nameEl.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
            nameEl.style.display = 'block';

            const reader = new FileReader();
            reader.onload = function(e) {
                const box = document.getElementById('heroImagePreviewBox');
                const img = document.getElementById('heroImagePreviewImg');
                img.src = e.target.result;
                box.classList.remove('d-none');
                box.classList.add('d-flex');
            };
            reader.readAsDataURL(file);

            const dz = document.getElementById('heroImageDropZone');
            dz.style.borderColor = 'var(--accent-red)';
            dz.style.background  = '#fff5f5';
        }

        function handleHeroImageDrop(event) {
            event.preventDefault();
            const dz = document.getElementById('heroImageDropZone');
            dz.style.borderColor = '#dee2e6';
            dz.style.background  = '';
            const file = event.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('heroImageFileInput').files = dt.files;
                handleHeroImageFile(file);
            }
        }

        function handleHeroVideoFile(file) {
            if (!file) return;
            const nameEl = document.getElementById('heroVideoFileName');
            nameEl.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
            nameEl.style.display = 'block';

            const box = document.getElementById('heroVideoPreviewBox');
            const player = document.getElementById('heroVideoPreviewPlayer');
            player.src = URL.createObjectURL(file);
            box.classList.remove('d-none');
            box.classList.add('d-flex');

            const dz = document.getElementById('heroVideoDropZone');
            dz.style.borderColor = 'var(--accent-red)';
            dz.style.background  = '#fff5f5';
        }

        function handleHeroVideoDrop(event) {
            event.preventDefault();
            const dz = document.getElementById('heroVideoDropZone');
            dz.style.borderColor = '#dee2e6';
            dz.style.background  = '';
            const file = event.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('heroVideoFileInput').files = dt.files;
                handleHeroVideoFile(file);
            }
        }

        // ==========================================
        // Direct Contacts Manager (Tambah, Edit, Hapus)
        // ==========================================
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('contactsContainer');
            const btnAdd = document.getElementById('btnAddContact');
            const emptyAlert = document.getElementById('emptyContactsAlert');

            function updateContactNumbers() {
                if (!container) return;
                const cards = container.querySelectorAll('.contact-card');
                if (cards.length === 0) {
                    if (emptyAlert) emptyAlert.classList.remove('d-none');
                } else {
                    if (emptyAlert) emptyAlert.classList.add('d-none');
                }

                cards.forEach((card, index) => {
                    const number = index + 1;
                    const badge = card.querySelector('.contact-badge');
                    if (badge) {
                        badge.innerHTML = `<i class="bi bi-person-badge me-1"></i> Kontak #${number}`;
                    }

                    const nameInput = card.querySelector('.input-cp-name');
                    if (nameInput) {
                        nameInput.name = `contact_persons[${index}][name]`;
                    }

                    const phoneInput = card.querySelector('.input-cp-phone');
                    if (phoneInput) {
                        phoneInput.name = `contact_persons[${index}][phone]`;
                    }
                });
            }

            // AJAX sync helper: Simpan langsung ke database secara instan
            function sendContactsToServer(showToast = true, toastMsg = 'Kontak berhasil disimpan!') {
                const cards = container ? container.querySelectorAll('.contact-card') : [];
                const contactsData = [];
                cards.forEach(card => {
                    const name = card.querySelector('.input-cp-name') ? card.querySelector('.input-cp-name').value.trim() : '';
                    const phone = card.querySelector('.input-cp-phone') ? card.querySelector('.input-cp-phone').value.trim() : '';
                    if (name || phone) {
                        contactsData.push({ name: name, phone: phone });
                    }
                });

                const token = document.querySelector('meta[name="csrf-token"]') 
                           ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                           : (document.querySelector('input[name="_token"]') ? document.querySelector('input[name="_token"]').value : '');

                const indicator = document.getElementById('contacts-save-indicator');
                if (indicator) {
                    indicator.className = 'small text-primary fw-bold';
                    indicator.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Menyimpan...';
                    indicator.classList.remove('d-none');
                }

                return fetch('{{ route("admin.settings.contacts.save") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ contact_persons: contactsData })
                })
                .then(res => res.json())
                .then(data => {
                    if (indicator) {
                        indicator.className = 'small text-success fw-bold';
                        indicator.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> ' + toastMsg;
                        setTimeout(() => {
                            indicator.classList.add('d-none');
                        }, 4000);
                    }
                    return data;
                })
                .catch(err => {
                    console.error('Save contacts error:', err);
                    if (indicator) {
                        indicator.className = 'small text-danger fw-bold';
                        indicator.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-1"></i> Gagal menyimpan otomatis';
                    }
                });
            }

            // Save button click
            const btnSave = document.getElementById('btnSaveContacts');
            if (btnSave) {
                btnSave.addEventListener('click', function () {
                    sendContactsToServer(true, 'Semua kontak berhasil disimpan!');
                });
            }

            // Real-time title update as admin types
            if (container) {
                container.addEventListener('input', function (e) {
                    if (e.target.classList.contains('input-cp-name')) {
                        const card = e.target.closest('.contact-card');
                        const titleEl = card.querySelector('.contact-preview-title');
                        if (titleEl) {
                            titleEl.textContent = e.target.value.trim() || 'Kontak Baru';
                        }
                    }
                });

                // Delete contact person (Instan terhapus & langsung tersimpan ke database!)
                container.addEventListener('click', function (e) {
                    const btnDelete = e.target.closest('.btn-delete-contact');
                    if (btnDelete) {
                        const card = btnDelete.closest('.contact-card');
                        const nameInput = card.querySelector('.input-cp-name');
                        const contactName = nameInput ? nameInput.value.trim() : '';
                        const displayName = contactName ? `"${contactName}"` : 'kontak ini';

                        const confirmCallback = () => {
                            card.style.opacity = '0';
                            card.style.transform = 'translateX(20px)';
                            setTimeout(() => {
                                card.remove();
                                updateContactNumbers();
                                sendContactsToServer(true, 'Kontak berhasil dihapus & tersimpan otomatis!');
                            }, 200);
                        };

                        if (typeof window.systemConfirm === 'function') {
                            window.systemConfirm(`Apakah Anda yakin ingin menghapus ${displayName}?`, confirmCallback, 'Hapus Kontak', 'Ya, Hapus');
                        } else if (confirm(`Apakah Anda yakin ingin menghapus ${displayName}?`)) {
                            confirmCallback();
                        }
                    }
                });
            }

            // Add new contact person
            if (btnAdd && container) {
                btnAdd.addEventListener('click', function () {
                    const currentCards = container.querySelectorAll('.contact-card');
                    const newIndex = currentCards.length;
                    const newNumber = newIndex + 1;

                    const newCard = document.createElement('div');
                    newCard.className = 'contact-card p-3 mb-3 border rounded-3 bg-white shadow-sm position-relative';
                    newCard.style.borderLeft = '4px solid var(--accent-red) !important';
                    newCard.style.opacity = '0';
                    newCard.style.transform = 'translateY(15px)';
                    newCard.style.transition = 'all 0.25s ease';

                    newCard.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge rounded-pill px-2.5 py-1 contact-badge" style="background-color: var(--accent-red); font-size: 0.78rem;">
                                    <i class="bi bi-person-badge me-1"></i> Kontak #${newNumber}
                                </span>
                                <span class="small fw-bold text-dark contact-preview-title">Kontak Baru</span>
                            </div>
                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1 btn-delete-contact" title="Hapus kontak ini">
                                <i class="bi bi-trash3-fill me-1"></i> Hapus
                            </button>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary mb-1">Nama / Jabatan CP <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-person-fill text-danger"></i></span>
                                    <input type="text" class="form-control input-cp-name" name="contact_persons[${newIndex}][name]" value="" placeholder="Contoh: (Direktur) Enung Kosasih" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary mb-1">Nomor Telepon / WhatsApp <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-success"><i class="bi bi-whatsapp"></i></span>
                                    <input type="text" class="form-control input-cp-phone" name="contact_persons[${newIndex}][phone]" value="" placeholder="Contoh: 0856 9317 4242" required>
                                </div>
                            </div>
                        </div>
                    `;

                    container.appendChild(newCard);
                    if (emptyAlert) emptyAlert.classList.add('d-none');

                    requestAnimationFrame(() => {
                        newCard.style.opacity = '1';
                        newCard.style.transform = 'translateY(0)';
                    });

                    const inputToFocus = newCard.querySelector('.input-cp-name');
                    if (inputToFocus) {
                        inputToFocus.focus();
                    }
                });
            }
        });

        // ==========================================
        // Office Emails Dynamic Manager (Tambah / Hapus)
        // ==========================================
        window.addNewEmailRow = function () {
            const emailsContainer = document.getElementById('emailsContainer');
            if (!emailsContainer) return;

            const newRow = document.createElement('div');
            newRow.className = 'input-group email-row';
            newRow.style.opacity = '0';
            newRow.style.transform = 'translateY(8px)';
            newRow.style.transition = 'all 0.25s ease';

            newRow.innerHTML = `
                <span class="input-group-text bg-light text-muted">
                    <i class="bi bi-envelope-fill text-danger"></i>
                </span>
                <input type="email" 
                       class="form-control input-office-email" 
                       name="emails[]" 
                       value="" 
                       placeholder="contoh: support@boutiquedesign.com" 
                       required>
                <button type="button" class="btn btn-outline-danger btn-delete-email" onclick="deleteEmailRow(this)" title="Hapus email ini">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            `;

            emailsContainer.appendChild(newRow);

            requestAnimationFrame(() => {
                newRow.style.opacity = '1';
                newRow.style.transform = 'translateY(0)';
            });

            window.updateDeleteEmailButtons();

            const inputEl = newRow.querySelector('.input-office-email');
            if (inputEl) {
                inputEl.focus();
            }
        };

        window.deleteEmailRow = function (btn) {
            if (!btn || btn.disabled) return;
            const emailsContainer = document.getElementById('emailsContainer');
            const row = btn.closest('.email-row');
            if (row && emailsContainer) {
                const rows = emailsContainer.querySelectorAll('.email-row');
                if (rows.length <= 1) return;

                row.style.opacity = '0';
                row.style.transform = 'translateX(20px)';
                setTimeout(() => {
                    row.remove();
                    window.updateDeleteEmailButtons();
                }, 200);
            }
        };

        window.updateDeleteEmailButtons = function () {
            const emailsContainer = document.getElementById('emailsContainer');
            if (!emailsContainer) return;
            const rows = emailsContainer.querySelectorAll('.email-row');
            const btnDeletes = emailsContainer.querySelectorAll('.btn-delete-email');

            btnDeletes.forEach(btn => {
                if (rows.length <= 1) {
                    btn.disabled = true;
                    btn.style.opacity = '0.4';
                    btn.style.cursor = 'not-allowed';
                } else {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                    btn.style.cursor = 'pointer';
                }
            });
        };

        // Initialize and bind events on load
        document.addEventListener('DOMContentLoaded', function () {
            const btnAddEmail = document.getElementById('btnAddEmail');
            if (btnAddEmail) {
                btnAddEmail.addEventListener('click', function (e) {
                    e.preventDefault();
                    window.addNewEmailRow();
                });
            }

            const emailsContainer = document.getElementById('emailsContainer');
            if (emailsContainer) {
                emailsContainer.addEventListener('click', function (e) {
                    const btnDelete = e.target.closest('.btn-delete-email');
                    if (btnDelete) {
                        e.preventDefault();
                        window.deleteEmailRow(btnDelete);
                    }
                });
            }

            window.updateDeleteEmailButtons();
        });
    </script>
@endsection
