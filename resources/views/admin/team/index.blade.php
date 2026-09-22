@extends('admin.layout')

@section('title', 'Manage Team Members')
@section('topbar_title', 'Team Manager')

@section('content')
    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="h5 fw-bold m-0" style="color:var(--text-dark);">All Team Members</h4>
            <a href="{{ route('admin.team.create') }}" class="btn btn-danger btn-sm rounded-pill px-4" style="background-color: var(--accent-red); border-color: var(--accent-red);">
                <i class="bi bi-person-plus me-1"></i> Add Team Member
            </a>
        </div>

        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th style="width: 70px;">Avatar</th>
                        <th>Name</th>
                        <th>Role (EN / ID)</th>
                        <th>Phone</th>
                        <th>Priority</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($team as $member)
                        <tr>
                            <td>
                                @if($member->photo_path)
                                    <img src="{{ asset($member->photo_path) }}" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover; border: 2px solid #e2e8f0;">
                                @else
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center fw-bold text-white text-uppercase" style="width: 45px; height: 45px; font-size: 0.95rem;">
                                        {{ collect(explode(' ', $member->name))->map(fn($n) => $n[0])->take(2)->implode('') }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $member->name }}</div>
                                @if($member->quote_en)
                                    <div class="small text-muted text-truncate" style="max-width: 250px;"><span class="text-danger small fw-bold">EN:</span> "{{ $member->quote_en }}"</div>
                                @endif
                                @if($member->quote_id)
                                    <div class="small text-muted text-truncate" style="max-width: 250px;"><span class="text-warning small fw-bold">ID:</span> "{{ $member->quote_id }}"</div>
                                @endif
                            </td>
                            <td>
                                <div class="badge bg-secondary-subtle text-dark border px-2 py-1 mb-1">{{ $member->role_en }}</div>
                                <div class="text-muted small" style="font-style: italic;">{{ $member->role_id }}</div>
                            </td>
                            <td>
                                @if($member->phone)
                                    <a href="tel:{{ $member->phone }}" class="text-decoration-none small text-muted"><i class="bi bi-telephone me-1"></i>{{ $member->phone }}</a>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1">{{ $member->priority }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.team.edit', $member->id) }}" class="btn btn-light btn-action text-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this team member?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-action text-danger" title="Remove">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No team members found. Click "Add Team Member" to register.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
