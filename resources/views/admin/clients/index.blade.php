@extends('admin.layout')

@section('title', 'Manage Clients')
@section('topbar_title', 'Manage Clients')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="m-0" style="font-weight: 700;">Clients</h4>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-dark rounded-pill px-4">
        <i class="bi bi-plus-lg me-1"></i> Add Client
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width: 80px;">Logo</th>
                    <th>Name</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>
                        @if($client->logo)
                            <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: contain; background: #fff;">
                        @else
                            <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <h6 class="mb-0 fw-bold">{{ $client->name }}</h6>
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn-action bg-light text-dark" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action bg-light text-danger border-0" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">No clients added yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
