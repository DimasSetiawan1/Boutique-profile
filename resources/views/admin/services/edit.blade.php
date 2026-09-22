@extends('admin.layout')

@section('title', 'Edit Service')
@section('topbar_title', 'Services Manager')

@section('content')
    <div class="admin-card" style="max-width: 800px;">
        <h4 class="h5 fw-bold mb-4" style="color:var(--text-dark);">Edit Service</h4>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title_id" class="form-label small fw-bold text-secondary">Service Title (Indonesian) *</label>
                    <input type="text" class="form-control @error('title_id') is-invalid @enderror" id="title_id" name="title_id" value="{{ old('title_id', $service->title_id) }}" required placeholder="contoh: Paket Logo & Branding">
                    @error('title_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="title_en" class="form-label small fw-bold text-secondary">Service Title (English)</label>
                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en" value="{{ old('title_en', $service->title_en) }}" placeholder="e.g. Logo & Branding Package">
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="description_id" class="form-label small fw-bold text-secondary">Service Description (Indonesian) *</label>
                    <textarea class="form-control @error('description_id') is-invalid @enderror" id="description_id" name="description_id" rows="5" required placeholder="Berikan rincian tentang apa saja yang ditawarkan layanan ini...">{{ old('description_id', $service->description_id) }}</textarea>
                    @error('description_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-4">
                    <label for="description_en" class="form-label small fw-bold text-secondary">Service Description (English)</label>
                    <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en" rows="5" placeholder="Provide details about what this service entails...">{{ old('description_en', $service->description_en) }}</textarea>
                    @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-danger rounded-pill px-4" style="background-color:var(--accent-red); border-color:var(--accent-red);">
                    Update Service
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
