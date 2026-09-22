@extends('admin.layout')

@section('title', 'Add Portfolio Item')
@section('topbar_title', 'Portfolio Manager')

@section('content')
    <div class="admin-card" style="max-width: 800px;">
        <h4 class="h5 fw-bold mb-4" style="color:var(--text-dark);">Add New Portfolio Item</h4>

        <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title_id" class="form-label small fw-bold text-secondary">Item Title (Indonesian) *</label>
                    <input type="text" class="form-control @error('title_id') is-invalid @enderror" id="title_id" name="title_id" value="{{ old('title_id') }}" required placeholder="contoh: Gimmick Handuk Tangan Hello Kitty">
                    @error('title_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="title_en" class="form-label small fw-bold text-secondary">Item Title (English)</label>
                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en" value="{{ old('title_en') }}" placeholder="e.g. Hello Kitty Hand Towel Gimmick">
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label small fw-bold text-secondary">Portfolio Image (Optional)</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                <div class="form-text small text-muted">Upload an image file (PNG, JPG, JPEG, SVG, WebP) max 2MB. If none is uploaded, a category icon placeholder is used.</div>
                @error('image')
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
@endsection
