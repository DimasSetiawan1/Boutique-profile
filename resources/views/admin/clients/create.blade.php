@extends('admin.layout')

@section('title', 'Add Client')
@section('topbar_title', 'Add Client')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.clients.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block">
        <i class="bi bi-arrow-left me-1"></i> Back to Clients
    </a>
    <h4 class="m-0 fw-bold">Add New Client</h4>
</div>

<div class="admin-card">
    <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Client Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Product Images</label>
            <input type="file" name="product_images[]" class="form-control" accept="image/*" multiple>
            <small class="text-muted d-block mt-1">Upload multiple product images for this client.</small>
            @error('product_images.*') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Client Logo</label>
            <input type="file" name="logo" class="form-control" accept="image/*">
            <small class="text-muted d-block mt-1">Recommended format: PNG with transparent background. Max size 2MB.</small>
            @error('logo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-dark rounded-pill px-4">Save Client</button>
    </form>
</div>
@endsection
