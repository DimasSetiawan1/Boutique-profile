@extends('admin.layout')

@section('title', 'Manage Services')
@section('topbar_title', 'Services Manager')

@section('content')
    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="h5 fw-bold m-0" style="color:var(--text-dark);">All Services</h4>
            <a href="{{ route('admin.services.create') }}" class="btn btn-danger btn-sm rounded-pill px-4" style="background-color: var(--accent-red); border-color: var(--accent-red);">
                <i class="bi bi-plus-lg me-1"></i> Add Service
            </a>
        </div>

        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Service Title (EN / ID)</th>
                        <th>Category</th>
                        <th style="width: 40%;">Description (EN / ID)</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>
                                <div class="fw-bold">{{ $service->title_en }}</div>
                                <div class="text-muted small" style="font-style: italic;">{{ $service->title_id }}</div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-dark border px-2 py-1">{{ $service->category }}</span>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 350px;" title="{{ $service->description_en }}">
                                    <span class="text-danger small fw-bold">EN:</span> {{ $service->description_en ?? '-' }}
                                </div>
                                <div class="text-truncate text-muted small" style="max-width: 350px;" title="{{ $service->description_id }}">
                                    <span class="text-warning small fw-bold">ID:</span> {{ $service->description_id ?? '-' }}
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-light btn-action text-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?')">
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
                            <td colspan="5" class="text-center text-muted py-4">No services records found. Click "Add Service" to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
