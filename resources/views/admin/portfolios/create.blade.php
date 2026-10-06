@extends('admin.layout')

@section('title', 'Add Portfolio Item')
@section('topbar_title', 'Portfolio Manager')

@section('content')
    <div class="admin-card" style="max-width: 800px;">
        <h4 class="h5 fw-bold mb-4" style="color:var(--text-dark);">Add New Portfolio Item</h4>

        <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @if($existingTitles->count() > 0)
                <div class="mb-4 p-3 bg-light border rounded">
                    <label for="existing_title_select" class="form-label small fw-bold text-primary"><i class="bi bi-list-ul me-1"></i> Pilih dari Portofolio yang Sudah Ada (Opsional)</label>
                    <select class="form-select" id="existing_title_select">
                        <option value="">-- Buat Judul Baru (Ketik di bawah) --</option>
                        @foreach($existingTitles as $title)
                            <option value="{{ $title->title_id }}" data-en="{{ $title->title_en }}">{{ $title->title_id }}</option>
                        @endforeach
                    </select>
                    <div class="form-text small text-muted">Pilih dari daftar ini agar Anda tidak perlu mengetik ulang jika ini adalah portofolio untuk tipe yang sama.</div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title_id" class="form-label small fw-bold text-secondary">Item Title (Indonesian) *</label>
                    <input type="text" class="form-control @error('title_id') is-invalid @enderror" id="title_id" name="title_id" value="{{ old('title_id') }}" required placeholder="contoh: Gimmick Handuk Tangan Hello Kitty" list="existing_titles_id" autocomplete="off">
                    <datalist id="existing_titles_id">
                        @foreach($existingTitles as $title)
                            @if(!empty($title->title_id))
                                <option value="{{ $title->title_id }}"></option>
                            @endif
                        @endforeach
                    </datalist>
                    @error('title_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="title_en" class="form-label small fw-bold text-secondary">Item Title (English)</label>
                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en" value="{{ old('title_en') }}" placeholder="e.g. Hello Kitty Hand Towel Gimmick" list="existing_titles_en" autocomplete="off">
                    <datalist id="existing_titles_en">
                        @foreach($existingTitles as $title)
                            @if(!empty($title->title_en))
                                <option value="{{ $title->title_en }}"></option>
                            @endif
                        @endforeach
                    </datalist>
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="images" class="form-label small fw-bold text-secondary">Portfolio Images (Optional)</label>
                <input type="file" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" id="images" name="images[]" accept="image/*" multiple>
                <div class="form-text small text-muted">Upload one or multiple images (PNG, JPG, JPEG, SVG, WebP) max 2MB per file. You can select multiple files at once.</div>
                <div id="image_preview_container" class="mt-3 d-flex flex-wrap gap-2"></div>
                @error('images')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @error('images.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="description_id" class="form-label small fw-bold text-secondary">Description (Indonesian) *</label>
                    <textarea class="form-control @error('description_id') is-invalid @enderror" id="description_id" name="description_id" rows="4" required placeholder="Describe the item in Indonesian...">{{ old('description_id') }}</textarea>
                    @error('description_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-4">
                    <label for="description_en" class="form-label small fw-bold text-secondary">Description (English)</label>
                    <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en" rows="4" placeholder="Describe the item in English...">{{ old('description_en') }}</textarea>
                    @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-danger rounded-pill px-4" style="background-color:var(--accent-red); border-color:var(--accent-red);">
                    Save Item
                </button>
                <a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('existing_title_select');
            const inputId = document.getElementById('title_id');
            const inputEn = document.getElementById('title_en');
            const imageInput = document.getElementById('images');
            const previewContainer = document.getElementById('image_preview_container');

            if (select) {
                select.addEventListener('change', function() {
                    if (this.value) {
                        inputId.value = this.value;
                        const option = this.options[this.selectedIndex];
                        if (option.dataset.en) {
                            inputEn.value = option.dataset.en;
                            inputEn.classList.add('field-translated-flash');
                            inputId.classList.add('field-translated-flash');
                            setTimeout(() => {
                                inputEn.classList.remove('field-translated-flash');
                                inputId.classList.remove('field-translated-flash');
                            }, 1200);
                        }
                    }
                });
            }

            if (imageInput && previewContainer) {
                imageInput.addEventListener('change', function() {
                    previewContainer.innerHTML = '';
                    if (this.files) {
                        Array.from(this.files).forEach(file => {
                            if (file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.className = 'img-thumbnail';
                                    img.style.height = '100px';
                                    img.style.width = '120px';
                                    img.style.objectFit = 'cover';
                                    previewContainer.appendChild(img);
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection
