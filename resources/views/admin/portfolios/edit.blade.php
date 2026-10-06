@extends('admin.layout')

@section('title', 'Edit Portfolio Item')
@section('topbar_title', 'Portfolio Manager')

@section('content')
    <div class="admin-card" style="max-width: 800px;">
        <h4 class="h5 fw-bold mb-4" style="color:var(--text-dark);">Edit Portfolio Item</h4>

        <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @if($existingTitles->count() > 0)
                <div class="mb-4 p-3 bg-light border rounded">
                    <label for="existing_title_select" class="form-label small fw-bold text-primary"><i class="bi bi-list-ul me-1"></i> Pilih dari Portofolio yang Sudah Ada (Opsional)</label>
                    <select class="form-select" id="existing_title_select">
                        <option value="">-- Pertahankan Judul Saat Ini / Buat Baru (Ketik di bawah) --</option>
                        @foreach($existingTitles as $title)
                            <option value="{{ $title->title_id }}" data-en="{{ $title->title_en }}">{{ $title->title_id }}</option>
                        @endforeach
                    </select>
                    <div class="form-text small text-muted">Pilih dari daftar ini agar Anda tidak perlu mengetik ulang jika Anda ingin mengganti tipe portofolio ini.</div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title_id" class="form-label small fw-bold text-secondary">Item Title (Indonesian) *</label>
                    <input type="text" class="form-control @error('title_id') is-invalid @enderror" id="title_id" name="title_id" value="{{ old('title_id', $portfolio->title_id) }}" required placeholder="contoh: Gimmick Handuk Tangan Hello Kitty" list="existing_titles_id" autocomplete="off">
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
                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en" value="{{ old('title_en', $portfolio->title_en) }}" placeholder="e.g. Hello Kitty Hand Towel Gimmick" list="existing_titles_en" autocomplete="off">
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
                <label class="form-label small fw-bold text-secondary d-block">Current Images</label>
                @if($portfolio->images && $portfolio->images->count() > 0)
                    <div class="mb-3 d-flex flex-wrap gap-2">
                        @foreach($portfolio->images as $img)
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset($img->image_path) }}" class="rounded-3" style="width: 120px; height: 90px; object-fit: cover; border: 1px solid #e2e8f0;">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle" style="width: 24px; height: 24px; padding: 0; display: flex; align-items: center; justify-content: center; z-index: 10;" title="Delete this image" onclick="if(confirm('Are you sure you want to delete this image?')) document.getElementById('delete-img-{{ $img->id }}').submit();">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @elseif($portfolio->image_path)
                    <div class="mb-3 d-flex flex-wrap gap-2">
                        <img src="{{ asset($portfolio->image_path) }}" class="rounded-3" style="width: 120px; height: 90px; object-fit: cover; border: 1px solid #e2e8f0;">
                    </div>
                @else
                    <div class="alert alert-light border py-2 px-3 small text-muted mb-2 d-inline-block">
                        No image uploaded (using SVG category icon placeholder)
                    </div>
                @endif

                <label for="images" class="form-label small fw-bold text-secondary d-block">Add Images (Optional)</label>
                <input type="file" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" id="images" name="images[]" accept="image/*" multiple>
                <div class="form-text small text-muted">Upload one or multiple images (PNG, JPG, JPEG, SVG, WebP) max 2MB per file. <strong>Note: Existing images will be kept unless deleted.</strong></div>
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
                    <textarea class="form-control @error('description_id') is-invalid @enderror" id="description_id" name="description_id" rows="4" required placeholder="Describe the item in Indonesian...">{{ old('description_id', $portfolio->description_id) }}</textarea>
                    @error('description_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-4">
                    <label for="description_en" class="form-label small fw-bold text-secondary">Description (English)</label>
                    <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en" rows="4" placeholder="Describe the item in English...">{{ old('description_en', $portfolio->description_en) }}</textarea>
                    @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-danger rounded-pill px-4" style="background-color:var(--accent-red); border-color:var(--accent-red);">
                    Update Item
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

            if (select) {
                select.addEventListener('change', function() {
                    if (this.value) {
                        inputId.value = this.value;
                        const option = this.options[this.selectedIndex];
                        if (option.dataset.en) {
                            inputEn.value = option.dataset.en;
                            // Add a small visual cue
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
        });
    </script>
    @if($portfolio->images)
        @foreach($portfolio->images as $img)
            <form id="delete-img-{{ $img->id }}" action="{{ route('admin.portfolios.deleteImage', $img->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    @endif
@endsection
