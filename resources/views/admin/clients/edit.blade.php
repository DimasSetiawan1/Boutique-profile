@extends('admin.layout')

@section('title', 'Edit Client')
@section('topbar_title', 'Edit Client')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.clients.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block">
        <i class="bi bi-arrow-left me-1"></i> Back to Clients
    </a>
    <h4 class="m-0 fw-bold">Edit Client</h4>
</div>

<div class="admin-card">
    <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-semibold">Client Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $client->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Product Images</label>
            
            @if($client->productImages->count() > 0)
                <div class="mb-3 d-flex flex-wrap gap-3">
                    @foreach($client->productImages as $product)
                        <div class="position-relative">
                            <img src="{{ asset($product->image) }}" alt="Product Image" class="img-thumbnail" style="height: 80px; object-fit: contain; background:#fff;">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 translate-middle rounded-circle" 
                                    style="width: 24px; height: 24px; padding: 0; line-height: 1;"
                                    onclick="if(confirm('Delete this product image?')) { document.getElementById('delete-product-{{ $product->id }}').submit(); }">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif

            <input type="file" name="product_images[]" class="form-control" accept="image/*" multiple>
            <small class="text-muted d-block mt-1">Upload multiple product images. Existing images will be kept unless deleted.</small>
            @error('product_images.*') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Client Logo</label>
            
            @if($client->logo)
                <div class="mb-3">
                    <p class="mb-2 text-muted small">Current Logo:</p>
                    <img src="{{ asset($client->logo) }}" alt="Current Logo" id="edit-client-logo" class="img-thumbnail" style="max-height: 100px; background:#fff;">
                </div>
            @endif

            

        <!-- Interactive logo resize script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoImg = document.getElementById('edit-client-logo');
        const widthInput = document.querySelector('input[name="logo_width"]');
        const heightInput = document.querySelector('input[name="logo_height"]');
        if (!logoImg) return;
        let scale = 1;
        const originalWidth = logoImg.naturalWidth;
        const originalHeight = logoImg.naturalHeight;
        // Mouse wheel zoom
        logoImg.addEventListener('wheel', function (e) {
            e.preventDefault();
            const delta = e.deltaY < 0 ? 0.1 : -0.1;
            scale = Math.min(Math.max(scale + delta, 0.3), 3);
            const newW = Math.round(originalWidth * scale);
            const newH = Math.round(originalHeight * scale);
            logoImg.style.width = `${newW}px`;
            logoImg.style.height = `${newH}px`;
            if (widthInput) widthInput.value = newW;
            if (heightInput) heightInput.value = newH;
        });
        // Click resets size
        logoImg.addEventListener('click', function () {
            scale = 1;
            logoImg.style.width = '';
            logoImg.style.height = '';
            if (widthInput) widthInput.value = '';
            if (heightInput) heightInput.value = '';
        });
    });
</script>
</div>

        <button type="submit" class="btn btn-dark rounded-pill px-4">Update Client</button>
    </form>
    
    @foreach($client->productImages as $product)
        <form id="delete-product-{{ $product->id }}" action="{{ route('admin.clients.deleteProduct', $product->id) }}" method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
</div>
@endsection
