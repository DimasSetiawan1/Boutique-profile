@extends('admin.layout')

@section('title', 'Edit Philosophy Item')
@section('topbar_title', 'Philosophy Manager')

@section('content')
    <div class="admin-card" style="max-width: 850px;">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="h5 fw-bold m-0" style="color:var(--text-dark);">Edit Philosophy Item / Pillar</h4>
                <p class="text-secondary small mb-0 mt-1">Ubah informasi konsep, kata kunci, gambar, atau ikon filosofi.</p>
            </div>
            <a href="{{ route('admin.philosophies.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <form action="{{ route('admin.philosophies.update', $philosophy->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="title_id" class="form-label small fw-bold text-secondary">Title / Keyword (Indonesian) *</label>
                    <input type="text" class="form-control @error('title_id') is-invalid @enderror" id="title_id" name="title_id" value="{{ old('title_id', $philosophy->title_id) }}" required>
                    @error('title_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="title_en" class="form-label small fw-bold text-secondary">Title / Keyword (English)</label>
                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en" value="{{ old('title_en', $philosophy->title_en) }}">
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="subtitle_id" class="form-label small fw-bold text-secondary">Concept Subtitle (Indonesian)</label>
                    <input type="text" class="form-control @error('subtitle_id') is-invalid @enderror" id="subtitle_id" name="subtitle_id" value="{{ old('subtitle_id', $philosophy->subtitle_id) }}">
                    @error('subtitle_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="subtitle_en" class="form-label small fw-bold text-secondary">Concept Subtitle (English)</label>
                    <input type="text" class="form-control @error('subtitle_en') is-invalid @enderror" id="subtitle_en" name="subtitle_en" value="{{ old('subtitle_en', $philosophy->subtitle_en) }}">
                    @error('subtitle_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="icon" class="form-label small fw-bold text-secondary">Bootstrap Icon Class</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi {{ $philosophy->icon ?: 'bi-lightbulb-fill' }}" id="iconPreview"></i></span>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $philosophy->icon) }}" oninput="document.getElementById('iconPreview').className='bi '+this.value">
                    </div>
                    <small class="text-muted" style="font-size:0.75rem;">Contoh: <code>bi-lightbulb-fill</code>, <code>bi-people-fill</code>, <code>bi-gear-wide-connected</code>, <code>bi-cpu-fill</code></small>
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="sort_order" class="form-label small fw-bold text-secondary">Sort Order</label>
                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $philosophy->sort_order) }}">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 d-flex align-items-center mt-4 pt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_highlighted" name="is_highlighted" value="1" {{ old('is_highlighted', $philosophy->is_highlighted) ? 'checked' : '' }}>
                        <label class="form-check-label small fw-bold text-dark" for="is_highlighted">
                            Dark Highlight Pill
                        </label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label small fw-bold text-secondary">Philosophy Item Image / Infographic (Optional)</label>
                @if($philosophy->image_path && file_exists(public_path($philosophy->image_path)))
                    <div class="mb-2 d-flex align-items-center gap-3 p-2 bg-light rounded-3 border">
                        <img src="{{ asset($philosophy->image_path) }}" alt="Preview" style="height:60px; width:auto; border-radius:6px;">
                        <span class="small text-muted">Gambar saat ini terpasang. Upload file baru jika ingin mengganti.</span>
                    </div>
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                <div class="form-text small text-muted">Upload gambar ilustrasi (PNG, JPG, JPEG, SVG, WebP) maks. 4MB.</div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="description_id" class="form-label small fw-bold text-secondary">Detailed Insight (Indonesian) *</label>
                    <textarea class="form-control @error('description_id') is-invalid @enderror" id="description_id" name="description_id" rows="4" required>{{ old('description_id', $philosophy->description_id) }}</textarea>
                    @error('description_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="description_en" class="form-label small fw-bold text-secondary">Detailed Insight (English)</label>
                    <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en" rows="4">{{ old('description_en', $philosophy->description_en) }}</textarea>
                    @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-3 pt-3 border-top">
                <button type="submit" class="btn btn-danger rounded-pill px-4" style="background-color:var(--accent-red); border-color:var(--accent-red); font-weight:600;">
                    Update Philosophy Item
                </button>
                <a href="{{ route('admin.philosophies.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
