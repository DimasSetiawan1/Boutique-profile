@extends('admin.layout')

@section('title', 'Manage Portfolios')
@section('topbar_title', 'Portfolio Manager')

@section('content')
    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="h5 fw-bold m-0" style="color:var(--text-dark);">All Portfolio Items</h4>
            <a href="{{ route('admin.portfolios.create') }}" class="btn btn-danger btn-sm rounded-pill px-4" style="background-color: var(--accent-red); border-color: var(--accent-red);">
                <i class="bi bi-plus-lg me-1"></i> Add Portfolio Item
            </a>
        </div>

        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">Thumbnail</th>
                        <th>Item Title (EN / ID)</th>
                        <th style="width: 50%;">Description (EN / ID)</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($portfolios as $work)
                        <tr>
                            <td>
                                @if($work->image_path)
                                    <img src="{{ asset($work->image_path) }}" class="rounded-3" style="width: 60px; height: 45px; object-fit: cover; border: 1px solid #e2e8f0;">
                                @else
                                    <div class="rounded-3 bg-secondary-subtle d-flex align-items-center justify-content-center border" style="width: 60px; height: 45px; font-size: 0.75rem; font-weight: 700; color: #64748b;">
                                        SVG
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $work->title_en }}</div>
                                <div class="text-muted small" style="font-style: italic;">{{ $work->title_id }}</div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 350px;" title="{{ $work->description_en }}">
                                    <span class="text-danger small fw-bold">EN:</span> {{ $work->description_en ?? '-' }}
                                </div>
                                <div class="text-truncate text-muted small" style="max-width: 350px;" title="{{ $work->description_id }}">
                                    <span class="text-warning small fw-bold">ID:</span> {{ $work->description_id ?? '-' }}
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.portfolios.edit', $work->id) }}" class="btn btn-light btn-action text-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.portfolios.destroy', $work->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this portfolio item?')">
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
                            <td colspan="4" class="text-center text-muted py-4">No portfolio items found. Click "Add Portfolio Item" to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
