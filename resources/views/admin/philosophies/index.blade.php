@extends('admin.layout')

@section('title', 'Manage Philosophy Items')
@section('topbar_title', 'Philosophy Manager')

@section('content')
    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="h5 fw-bold m-0" style="color:var(--text-dark);">All Philosophy Items / Pillars</h4>
                <p class="text-secondary small mb-0 mt-1">Kelola kata kunci, ikon, gambar, dan penjelasan konsep filosofi yang tampil interaktif di company profile.</p>
            </div>
            <a href="{{ route('admin.philosophies.create') }}" class="btn btn-danger btn-sm rounded-pill px-4" style="background-color: var(--accent-red); border-color: var(--accent-red); font-weight:600;">
                <i class="bi bi-plus-lg me-1"></i> Add Philosophy Item
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;">Order</th>
                        <th style="width: 70px;">Media</th>
                        <th style="width: 80px;">Icon</th>
                        <th>Title / Tag (ID / EN)</th>
                        <th>Concept Subtitle</th>
                        <th style="width: 35%;">Description (ID / EN)</th>
                        <th style="width: 90px;">Style</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($philosophies as $item)
                        <tr>
                            <td class="text-center fw-bold text-muted" style="font-size:0.85rem;">
                                {{ $item->sort_order }}
                            </td>
                            <td>
                                @if($item->image_path && file_exists(public_path($item->image_path)))
                                    <img src="{{ asset($item->image_path) }}" class="rounded-3 shadow-sm" style="width: 55px; height: 42px; object-fit: cover; border: 1px solid #e2e8f0;">
                                @else
                                    <div class="rounded-3 bg-light d-flex align-items-center justify-content-center border text-muted" style="width: 55px; height: 42px; font-size: 0.7rem; font-weight: 600;">
                                        SVG
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:36px; height:36px; background:rgba(198,40,40,0.1); color:var(--accent-red); font-size:1.1rem;">
                                    <i class="bi {{ $item->icon ?: 'bi-lightbulb-fill' }}"></i>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $item->title_id }}</div>
                                <div class="text-muted small" style="font-style: italic;">{{ $item->title_en }}</div>
                            </td>
                            <td>
                                <div class="small fw-semibold text-secondary">{{ $item->subtitle_id ?: '-' }}</div>
                                <div class="text-muted small" style="font-size:0.75rem;">{{ $item->subtitle_en ?: '-' }}</div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 320px;" title="{{ $item->description_id }}">
                                    <span class="text-danger small fw-bold">ID:</span> {{ $item->description_id ?? '-' }}
                                </div>
                                <div class="text-truncate text-muted small" style="max-width: 320px;" title="{{ $item->description_en }}">
                                    <span class="text-secondary small fw-bold">EN:</span> {{ $item->description_en ?? '-' }}
                                </div>
                            </td>
                            <td>
                                @if($item->is_highlighted)
                                    <span class="badge rounded-pill bg-dark text-white px-2 py-1" style="font-size:0.75rem;">Dark Pill</span>
                                @else
                                    <span class="badge rounded-pill bg-light text-secondary border px-2 py-1" style="font-size:0.75rem;">Normal</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.philosophies.edit', $item->id) }}" class="btn btn-light btn-action text-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.philosophies.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item filosofi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-action text-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada item filosofi. Klik "Add Philosophy Item" untuk menambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
