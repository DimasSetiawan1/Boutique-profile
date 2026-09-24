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
    <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data" id="clientEditForm">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-semibold">Client Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $client->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Product Images (Logo / Foto Produk) -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="form-label fw-semibold m-0">
                    <i class="bi bi-collection-fill text-danger me-1"></i> Product Images (Logo & Produk Klien)
                </label>
                <small class="text-muted"><i class="bi bi-info-circle text-primary me-1"></i> <strong>Klik gambar produk</strong> untuk memperbesar / memperkecil ukuran.</small>
            </div>
            
            @if($client->productImages->count() > 0)
                <div class="mb-3 d-flex flex-wrap gap-3 align-items-start" id="productImagesList">
                    @foreach($client->productImages as $product)
                        <div class="product-item-card position-relative p-2 rounded-3 border bg-white shadow-sm" id="card-product-{{ $product->id }}" style="transition: all 0.25s ease;">
                            <!-- Clickable Product Box -->
                            <div class="product-interactive-box position-relative d-flex align-items-center justify-content-center rounded overflow-hidden" 
                                 data-product-id="{{ $product->id }}"
                                 data-image-src="{{ asset($product->image) }}"
                                 data-current-width="{{ $product->width ?? 120 }}"
                                 data-current-height="{{ $product->height ?? 100 }}"
                                 style="cursor: pointer; min-width: 110px; min-height: 95px; background: #f8fafc; padding: 6px;"
                                 title="Klik logo produk ini untuk membuka pengaturan perbesar / perkecil ukuran">
                                
                                <img src="{{ asset($product->image) }}" 
                                     alt="Product Image" 
                                     id="preview-prod-img-{{ $product->id }}"
                                     class="img-fluid" 
                                     style="{{ $product->width ? 'max-width:'.$product->width.'px;' : 'max-width: 120px;' }}{{ $product->height ? ' max-height:'.$product->height.'px;' : ' max-height: 90px;' }} object-fit: contain; transition: all 0.2s ease;">
                                
                                <!-- Hover Overlay -->
                                <div class="product-hover-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center text-white" 
                                     style="background: rgba(15, 23, 42, 0.78); opacity: 0; transition: opacity 0.2s ease; backdrop-filter: blur(2px);">
                                    <i class="bi bi-arrows-angle-expand fs-4 mb-1 text-warning"></i>
                                    <span style="font-size: 0.72rem; font-weight: 700;">Atur Ukuran</span>
                                </div>
                            </div>

                            <!-- Size Badge & Delete Button -->
                            <div class="d-flex justify-content-between align-items-center mt-2 pt-1 border-top gap-1">
                                <span class="badge bg-light text-secondary border px-2 py-0.5" id="prod-size-badge-{{ $product->id }}" style="font-size: 0.72rem;" title="Ukuran lebar logo produk saat ini">
                                    <i class="bi bi-aspect-ratio me-1 text-danger"></i><span class="badge-text">{{ $product->width ? $product->width . 'px' : '120px' }}</span>
                                </span>
                                <button type="button" class="btn btn-outline-danger btn-sm p-0 rounded-circle d-flex align-items-center justify-content-center" 
                                        style="width: 24px; height: 24px;"
                                        title="Hapus gambar produk ini"
                                        onclick="window.systemConfirm('Apakah Anda yakin ingin menghapus gambar produk ini?', function() { document.getElementById('delete-product-{{ $product->id }}').submit(); }, 'Hapus Gambar Produk', 'Ya, Hapus')">
                                    <i class="bi bi-trash3-fill" style="font-size: 0.72rem;"></i>
                                </button>
                            </div>

                            <!-- Hidden inputs for this product -->
                            <input type="hidden" name="product_dimensions[{{ $product->id }}][width]" id="input_prod_width_{{ $product->id }}" value="{{ $product->width ?? 120 }}">
                            <input type="hidden" name="product_dimensions[{{ $product->id }}][height]" id="input_prod_height_{{ $product->id }}" value="{{ $product->height ?? 100 }}">
                        </div>
                    @endforeach
                </div>
            @endif

            <input type="file" name="product_images[]" class="form-control" accept="image/*" multiple>
            <small class="text-muted d-block mt-1">Upload multiple product images. Existing images will be kept unless deleted.</small>
            @error('product_images.*') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Client Logo -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Client Logo</label>
            
            @if($client->logo)
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2" style="max-width: 450px;">
                        <span class="text-muted small fw-semibold">Current Logo:</span>
                        <span class="badge bg-secondary-subtle text-dark border px-2 py-1" id="logo-size-indicator">
                            <i class="bi bi-aspect-ratio text-danger me-1"></i>
                            Ukuran: <span id="current-size-text" class="fw-bold">{{ $client->logo_width ? $client->logo_width . 'px' : 'Default' }}</span>
                        </span>
                    </div>

                    <!-- Clickable Logo Container with Hover Effect -->
                    <div class="logo-interactive-box position-relative d-inline-block rounded-3 border p-3 bg-white shadow-sm" 
                         id="trigger-logo-modal"
                         style="cursor: pointer; transition: all 0.25s ease;"
                         title="Klik logo klien untuk membuka pengaturan perbesar / perkecil ukuran">
                        <img src="{{ asset($client->logo) }}" 
                             alt="Current Logo" 
                             id="edit-client-logo" 
                             class="img-fluid rounded" 
                             style="{{ $client->logo_width ? 'max-width:'.$client->logo_width.'px;' : 'max-height: 100px;' }}{{ $client->logo_height ? ' max-height:'.$client->logo_height.'px;' : '' }} object-fit: contain; background:#fff; transition: all 0.2s ease;">
                        
                        <!-- Hover Overlay -->
                        <div class="logo-hover-overlay position-absolute top-0 start-0 w-100 h-100 rounded-3 d-flex flex-column align-items-center justify-content-center text-white" 
                             style="background: rgba(15, 23, 42, 0.78); opacity: 0; transition: opacity 0.2s ease; backdrop-filter: blur(2px);">
                            <i class="bi bi-arrows-angle-expand fs-3 mb-1 text-warning"></i>
                            <span class="small fw-bold">Klik untuk Atur Ukuran</span>
                            <span style="font-size: 0.72rem;" class="text-light">Perbesar / Perkecil Gambar</span>
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1" onclick="document.getElementById('trigger-logo-modal').click()">
                            <i class="bi bi-arrows-fullscreen me-1"></i> Buka Pengaturan Ukuran Logo Klien
                        </button>
                    </div>
                </div>
            @endif

            <input type="file" name="logo" id="client-logo-file-input" class="form-control" accept="image/*">
            <small class="text-muted d-block mt-1">Leave empty to keep current logo. Recommended format: PNG with transparent background. Max size 2MB.</small>
            @error('logo') <small class="text-danger">{{ $message }}</small> @enderror

            <!-- Hidden Inputs (User tidak perlu input manual lebar dan panjang) -->
            <input type="hidden" name="logo_width" id="input_logo_width" value="{{ old('logo_width', $client->logo_width) }}">
            <input type="hidden" name="logo_height" id="input_logo_height" value="{{ old('logo_height', $client->logo_height) }}">
        </div>

        <button type="submit" class="btn btn-dark rounded-pill px-4">Update Client</button>
    </form>

    <!-- Modal Pengaturan Ukuran Visual (Logo Klien & Logo Produk) -->
    <div class="modal fade" id="logoResizerModal" tabindex="-1" aria-labelledby="logoResizerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Modal Header -->
                <div class="modal-header bg-dark text-white px-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background-color: var(--accent-red) !important;">
                            <i class="bi bi-aspect-ratio text-white fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold m-0" id="logoResizerModalLabel">Pengaturan Ukuran Gambar</h5>
                            <p class="small text-white-50 m-0" id="logoResizerModalSubtitle">Atur perbesar atau perkecil tampilan gambar secara visual tanpa perlu mengetik angka manual.</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4 bg-light">
                    <!-- Canvas Preview Stage -->
                    <div class="card border mb-3 shadow-sm bg-white overflow-hidden">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center py-2 px-3">
                            <span class="small fw-semibold text-secondary"><i class="bi bi-eye me-1"></i> Preview Tampilan di Website</span>
                            <span class="badge bg-danger rounded-pill px-3 py-1" id="modal-scale-badge" style="background-color: var(--accent-red) !important; font-size: 0.82rem;">100% (Normal)</span>
                        </div>
                        <div class="card-body p-4 d-flex align-items-center justify-content-center position-relative" 
                             id="modal-preview-stage"
                             style="min-height: 230px; background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 16px 16px; user-select: none;">
                            
                            <!-- Image on Stage -->
                            <img id="modal-logo-img" 
                                 src="{{ $client->logo ? asset($client->logo) : '' }}" 
                                 alt="Preview Gambar" 
                                 class="img-fluid"
                                 style="max-height: 120px; object-fit: contain; transition: width 0.15s ease, height 0.15s ease; cursor: grab;">
                        </div>
                        <div class="card-footer bg-light py-2 text-center text-muted small">
                            <i class="bi bi-mouse me-1 text-danger"></i> Anda juga dapat memutar <strong>Scroll Mouse</strong> pada gambar di atas untuk memperbesar atau memperkecil secara langsung.
                        </div>
                    </div>

                    <!-- Visual Controls (NO TYPING!) -->
                    <div class="card border-0 bg-white p-3 shadow-sm rounded-3">
                        <div class="row align-items-center g-3 mb-3">
                            <div class="col-auto">
                                <span class="fw-bold small text-dark"><i class="bi bi-sliders me-1 text-danger"></i> Skala Ukuran:</span>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center gap-2">
                                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center" id="btn-scale-minus" style="width: 34px; height: 34px;" title="Perkecil">
                                        <i class="bi bi-dash-lg"></i>
                                    </button>
                                    <input type="range" class="form-range flex-grow-1" id="modal-scale-slider" min="30" max="300" step="5" value="100">
                                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center" id="btn-scale-plus" style="width: 34px; height: 34px;" title="Perbesar">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Presets -->
                        <div class="d-flex flex-wrap align-items-center gap-2 pt-2 border-top">
                            <span class="small text-muted me-1 fw-semibold">Ukuran Cepat:</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 btn-preset" data-scale="50">Sangat Kecil</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 btn-preset" data-scale="75">Kecil</button>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-preset active" data-scale="100" style="border-color: var(--accent-red);">Normal (100%)</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 btn-preset" data-scale="140">Besar</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 btn-preset" data-scale="190">Ekstra Besar</button>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-white px-4 py-3 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-3" id="btn-reset-scale">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset ke Normal
                    </button>
                    <div class="d-flex align-items-center gap-2">
                        <span id="modal-saving-status" class="small text-success fw-bold d-none">
                            <i class="bi bi-check-circle-fill me-1"></i> Tersimpan!
                        </span>
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger rounded-pill px-4 shadow-sm" id="btn-apply-size" style="background-color: var(--accent-red); border-color: var(--accent-red); font-weight: 600;">
                            <i class="bi bi-check-lg me-1"></i> Terapkan Ukuran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles for interactive hover -->
    <style>
        .logo-interactive-box:hover .logo-hover-overlay,
        .product-interactive-box:hover .product-hover-overlay {
            opacity: 1 !important;
        }
        .logo-interactive-box:hover,
        .product-item-card:hover {
            border-color: var(--accent-red) !important;
            box-shadow: 0 4px 15px rgba(198, 40, 40, 0.15) !important;
            transform: translateY(-2px);
        }
    </style>

    <!-- Unified Visual Resizer Script (Client Logo & Product Logos) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Modal elements
            const modalEl = document.getElementById('logoResizerModal');
            let resizerModal = null;
            if (modalEl && typeof bootstrap !== 'undefined') {
                resizerModal = new bootstrap.Modal(modalEl);
            }

            const modalTitle = document.getElementById('logoResizerModalLabel');
            const modalSubtitle = document.getElementById('logoResizerModalSubtitle');
            const modalImg = document.getElementById('modal-logo-img');
            const stage = document.getElementById('modal-preview-stage');
            const slider = document.getElementById('modal-scale-slider');
            const scaleBadge = document.getElementById('modal-scale-badge');
            const btnMinus = document.getElementById('btn-scale-minus');
            const btnPlus = document.getElementById('btn-scale-plus');
            const btnReset = document.getElementById('btn-reset-scale');
            const btnApply = document.getElementById('btn-apply-size');
            const presetBtns = document.querySelectorAll('.btn-preset');
            const savingStatus = document.getElementById('modal-saving-status');

            // Client Logo elements
            const triggerLogoBox = document.getElementById('trigger-logo-modal');
            const mainLogoImg = document.getElementById('edit-client-logo');
            const fileInput = document.getElementById('client-logo-file-input');
            const widthInput = document.getElementById('input_logo_width');
            const heightInput = document.getElementById('input_logo_height');
            const currentSizeText = document.getElementById('current-size-text');

            // Active Resizing Target State
            // targetType: 'client-logo' | 'product'
            let currentTargetType = 'client-logo';
            let currentProductId = null;
            let baseWidth = 140;
            let baseHeight = 80;
            let currentScale = 100;

            function updateBaseDimensions() {
                if (modalImg && modalImg.naturalWidth) {
                    baseWidth = modalImg.naturalWidth;
                    baseHeight = modalImg.naturalHeight;
                    
                    const maxNorm = 150;
                    if (baseWidth > maxNorm) {
                        const ratio = baseHeight / baseWidth;
                        baseWidth = maxNorm;
                        baseHeight = Math.round(maxNorm * ratio);
                    }
                }
            }

            function renderScale() {
                if (!modalImg) return;
                const factor = currentScale / 100;
                const targetW = Math.round(baseWidth * factor);
                const targetH = Math.round(baseHeight * factor);

                modalImg.style.width = targetW + 'px';
                modalImg.style.height = targetH + 'px';
                modalImg.style.maxWidth = 'none';
                modalImg.style.maxHeight = 'none';

                if (scaleBadge) {
                    let label = currentScale + '%';
                    if (currentScale < 80) label += ' (Kecil)';
                    else if (currentScale <= 110) label += ' (Normal)';
                    else if (currentScale <= 160) label += ' (Besar)';
                    else label += ' (Ekstra Besar)';
                    scaleBadge.textContent = label;
                }

                // Update preset active class
                presetBtns.forEach(btn => {
                    const sc = parseInt(btn.getAttribute('data-scale'));
                    if (Math.abs(sc - currentScale) < 5) {
                        btn.classList.add('btn-outline-danger', 'active');
                        btn.classList.remove('btn-outline-secondary');
                        btn.style.borderColor = 'var(--accent-red)';
                    } else {
                        btn.classList.remove('btn-outline-danger', 'active');
                        btn.classList.add('btn-outline-secondary');
                        btn.style.borderColor = '';
                    }
                });
            }

            function setScale(newScale) {
                currentScale = Math.max(30, Math.min(300, Math.round(newScale)));
                if (slider) slider.value = currentScale;
                renderScale();
            }

            // 1. OPEN MODAL FOR CLIENT LOGO
            if (triggerLogoBox) {
                triggerLogoBox.addEventListener('click', function () {
                    currentTargetType = 'client-logo';
                    currentProductId = null;

                    if (modalTitle) modalTitle.textContent = 'Pengaturan Ukuran Logo Klien';
                    if (modalSubtitle) modalSubtitle.textContent = 'Atur perbesar atau perkecil tampilan logo klien secara visual tanpa perlu mengetik angka.';
                    if (savingStatus) savingStatus.classList.add('d-none');

                    if (mainLogoImg) {
                        modalImg.src = mainLogoImg.src;
                    }

                    setTimeout(() => {
                        updateBaseDimensions();
                        // Restore saved scale if width exists
                        if (widthInput && widthInput.value && parseInt(widthInput.value) > 0) {
                            currentScale = Math.round((parseInt(widthInput.value) / baseWidth) * 100);
                            currentScale = Math.max(30, Math.min(300, currentScale));
                        } else {
                            currentScale = 100;
                        }
                        setScale(currentScale);
                        if (resizerModal) resizerModal.show();
                    }, 50);
                });
            }

            // 2. OPEN MODAL FOR PRODUCT LOGOS / IMAGES
            const productBoxes = document.querySelectorAll('.product-interactive-box');
            productBoxes.forEach(box => {
                box.addEventListener('click', function () {
                    currentTargetType = 'product';
                    currentProductId = this.getAttribute('data-product-id');
                    const imgSrc = this.getAttribute('data-image-src');
                    const savedWidth = parseInt(this.getAttribute('data-current-width') || '120');

                    if (modalTitle) modalTitle.textContent = 'Pengaturan Ukuran Logo / Gambar Produk';
                    if (modalSubtitle) modalSubtitle.textContent = 'Atur perbesar atau perkecil tampilan gambar produk ini secara visual tanpa mengetik angka.';
                    if (savingStatus) savingStatus.classList.add('d-none');

                    modalImg.src = imgSrc;

                    setTimeout(() => {
                        updateBaseDimensions();
                        if (savedWidth > 0 && baseWidth > 0) {
                            currentScale = Math.round((savedWidth / baseWidth) * 100);
                            currentScale = Math.max(30, Math.min(300, currentScale));
                        } else {
                            currentScale = 100;
                        }
                        setScale(currentScale);
                        if (resizerModal) resizerModal.show();
                    }, 50);
                });
            });

            // Slider input
            if (slider) {
                slider.addEventListener('input', function () {
                    setScale(this.value);
                });
            }

            // Plus & Minus buttons
            if (btnMinus) {
                btnMinus.addEventListener('click', function () {
                    setScale(currentScale - 10);
                });
            }
            if (btnPlus) {
                btnPlus.addEventListener('click', function () {
                    setScale(currentScale + 10);
                });
            }

            // Preset buttons
            presetBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const sc = parseInt(this.getAttribute('data-scale'));
                    if (sc) setScale(sc);
                });
            });

            // Reset scale button
            if (btnReset) {
                btnReset.addEventListener('click', function () {
                    setScale(100);
                });
            }

            // Mouse wheel zoom directly on stage/image
            if (stage) {
                stage.addEventListener('wheel', function (e) {
                    e.preventDefault();
                    const delta = e.deltaY < 0 ? 8 : -8;
                    setScale(currentScale + delta);
                }, { passive: false });
            }

            // APPLY SIZE BUTTON
            if (btnApply) {
                btnApply.addEventListener('click', function () {
                    const factor = currentScale / 100;
                    const finalW = Math.round(baseWidth * factor);
                    const finalH = Math.round(baseHeight * factor);

                    if (currentTargetType === 'client-logo') {
                        // Apply to Client Logo
                        if (widthInput) widthInput.value = finalW;
                        if (heightInput) heightInput.value = finalH;

                        if (mainLogoImg) {
                            mainLogoImg.style.width = finalW + 'px';
                            mainLogoImg.style.height = finalH + 'px';
                            mainLogoImg.style.maxWidth = 'none';
                            mainLogoImg.style.maxHeight = 'none';
                        }

                        if (currentSizeText) {
                            currentSizeText.textContent = finalW + 'px (' + currentScale + '%)';
                        }

                        if (resizerModal) resizerModal.hide();
                    } else if (currentTargetType === 'product' && currentProductId) {
                        // Apply to Product Image
                        const inputW = document.getElementById('input_prod_width_' + currentProductId);
                        const inputH = document.getElementById('input_prod_height_' + currentProductId);
                        const previewImg = document.getElementById('preview-prod-img-' + currentProductId);
                        const badgeEl = document.getElementById('prod-size-badge-' + currentProductId);
                        const boxEl = document.querySelector(`.product-interactive-box[data-product-id="${currentProductId}"]`);

                        if (inputW) inputW.value = finalW;
                        if (inputH) inputH.value = finalH;
                        if (boxEl) {
                            boxEl.setAttribute('data-current-width', finalW);
                            boxEl.setAttribute('data-current-height', finalH);
                        }

                        if (previewImg) {
                            previewImg.style.width = finalW + 'px';
                            previewImg.style.height = finalH + 'px';
                            previewImg.style.maxWidth = 'none';
                            previewImg.style.maxHeight = 'none';
                        }

                        if (badgeEl) {
                            const badgeText = badgeEl.querySelector('.badge-text');
                            if (badgeText) badgeText.textContent = finalW + 'px';
                            badgeEl.classList.remove('bg-light', 'text-secondary');
                            badgeEl.classList.add('bg-success-subtle', 'text-success', 'border-success');
                        }

                        // Send instant AJAX update to server
                        const token = document.querySelector('meta[name="csrf-token"]') 
                                    ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                                    : (document.querySelector('input[name="_token"]') ? document.querySelector('input[name="_token"]').value : '');

                        fetch(`/admin/clients/product/${currentProductId}/dimension`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ width: finalW, height: finalH })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (resizerModal) resizerModal.hide();
                        })
                        .catch(err => {
                            console.error('Save product dimension error:', err);
                            if (resizerModal) resizerModal.hide();
                        });
                    }
                });
            }

            // New logo upload listener
            if (fileInput) {
                fileInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (evt) {
                            if (mainLogoImg) {
                                mainLogoImg.src = evt.target.result;
                                mainLogoImg.style.width = '';
                                mainLogoImg.style.height = '';
                            }
                            if (modalImg) {
                                modalImg.src = evt.target.result;
                                modalImg.onload = function () {
                                    updateBaseDimensions();
                                    setScale(100);
                                };
                            }
                            if (triggerLogoBox) triggerLogoBox.style.display = 'inline-block';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
    
    @foreach($client->productImages as $product)
        <form id="delete-product-{{ $product->id }}" action="{{ route('admin.clients.deleteProduct', $product->id) }}" method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
</div>
@endsection
