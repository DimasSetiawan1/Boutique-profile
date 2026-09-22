@extends('admin.layout')

@section('title', 'Company Settings')
@section('topbar_title', 'Website Settings')

@section('content')

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
                    <label for="email" class="form-label small fw-bold text-secondary">Office Email Address *</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}" required>
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

            <h5 class="fw-bold mb-3 pb-2 border-bottom text-danger" style="font-size: 1.1rem; color:var(--accent-red) !important;"><i class="bi bi-person-lines-fill me-1"></i> Direct Contacts (Contact Persons)</h5>
            
            <div class="row g-3 mb-4">
                <!-- CP 1 -->
                <div class="col-md-6">
                    <label for="contact_person_1_name" class="form-label small fw-bold text-secondary">CP 1 Name</label>
                    <input type="text" class="form-control" id="contact_person_1_name" name="contact_person_1_name" value="{{ old('contact_person_1_name', $settings['contact_person_1_name'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label for="contact_person_1_phone" class="form-label small fw-bold text-secondary">CP 1 Phone</label>
                    <input type="text" class="form-control" id="contact_person_1_phone" name="contact_person_1_phone" value="{{ old('contact_person_1_phone', $settings['contact_person_1_phone'] ?? '') }}">
                </div>

                <!-- CP 2 -->
                <div class="col-md-6">
                    <label for="contact_person_2_name" class="form-label small fw-bold text-secondary">CP 2 Name</label>
                    <input type="text" class="form-control" id="contact_person_2_name" name="contact_person_2_name" value="{{ old('contact_person_2_name', $settings['contact_person_2_name'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label for="contact_person_2_phone" class="form-label small fw-bold text-secondary">CP 2 Phone</label>
                    <input type="text" class="form-control" id="contact_person_2_phone" name="contact_person_2_phone" value="{{ old('contact_person_2_phone', $settings['contact_person_2_phone'] ?? '') }}">
                </div>

                <!-- CP 3 -->
                <div class="col-md-6">
                    <label for="contact_person_3_name" class="form-label small fw-bold text-secondary">CP 3 Name</label>
                    <input type="text" class="form-control" id="contact_person_3_name" name="contact_person_3_name" value="{{ old('contact_person_3_name', $settings['contact_person_3_name'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label for="contact_person_3_phone" class="form-label small fw-bold text-secondary">CP 3 Phone</label>
                    <input type="text" class="form-control" id="contact_person_3_phone" name="contact_person_3_phone" value="{{ old('contact_person_3_phone', $settings['contact_person_3_phone'] ?? '') }}">
                </div>

                <!-- CP 4 -->
                <div class="col-md-6">
                    <label for="contact_person_4_name" class="form-label small fw-bold text-secondary">CP 4 Name</label>
                    <input type="text" class="form-control" id="contact_person_4_name" name="contact_person_4_name" value="{{ old('contact_person_4_name', $settings['contact_person_4_name'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label for="contact_person_4_phone" class="form-label small fw-bold text-secondary">CP 4 Phone</label>
                    <input type="text" class="form-control" id="contact_person_4_phone" name="contact_person_4_phone" value="{{ old('contact_person_4_phone', $settings['contact_person_4_phone'] ?? '') }}">
                </div>
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
    </script>
@endsection
