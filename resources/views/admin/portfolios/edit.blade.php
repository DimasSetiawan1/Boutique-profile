@extends('admin.layout')

@section('title', 'Edit Portfolio Item')
@section('topbar_title', 'Portfolio Manager')

@section('content')
    <div class="admin-card" style="max-width: 800px;">
        <h4 class="h5 fw-bold mb-4" style="color:var(--text-dark);">Edit Portfolio Item</h4>

        <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title_id" class="form-label small fw-bold text-secondary">Item Title (Indonesian) *</label>
                    <input type="text" class="form-control @error('title_id') is-invalid @enderror" id="title_id" name="title_id" value="{{ old('title_id', $portfolio->title_id) }}" required placeholder="contoh: Gimmick Handuk Tangan Hello Kitty">
                    @error('title_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="title_en" class="form-label small fw-bold text-secondary">Item Title (English)</label>
                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en" value="{{ old('title_en', $portfolio->title_en) }}" placeholder="e.g. Hello Kitty Hand Towel Gimmick">
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary d-block">Current Image</label>
                @if($portfolio->image_path)
                    <div class="mb-2">
                        <img src="{{ asset($portfolio->image_path) }}" class="rounded-3" style="width: 120px; height: 90px; object-fit: cover; border: 1px solid #e2e8f0;">
                    </div>
                @else
                    <div class="alert alert-light border py-2 px-3 small text-muted mb-2 d-inline-block">
                        No image uploaded (using SVG category icon placeholder)
                    </div>
                @endif

                <label for="image" class="form-label small fw-bold text-secondary d-block">Replace Image (Optional)</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                <div class="form-text small text-muted">Upload an image file (PNG, JPG, JPEG, SVG, WebP) max 2MB to replace the existing one.</div>
                @error('image')
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
@endsection
