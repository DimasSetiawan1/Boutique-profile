@extends('admin.layout')

@section('title', 'Inbox Messages')
@section('topbar_title', 'Inbox Messages')

@section('content')
    <div class="admin-card">
        <h4 class="h5 fw-bold mb-4" style="color:var(--text-dark);">Contact Submissions</h4>

        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th>Sender Info</th>
                        <th>Subject</th>
                        <th>Message Snippet</th>
                        <th>Received At</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr class="{{ $msg->status === 'unread' ? 'fw-bold' : '' }}">
                            <td>
                                <div>{{ $msg->name }}</div>
                                <div class="small text-muted fw-normal">{{ $msg->email }}</div>
                                @if($msg->phone)
                                    <div class="small text-muted fw-normal"><i class="bi bi-phone"></i> {{ $msg->phone }}</div>
                                @endif
                            </td>
                            <td>{{ $msg->subject ?? '(No Subject)' }}</td>
                            <td>
                                <div class="text-truncate fw-normal text-muted" style="max-width: 250px;">
                                    {{ $msg->message }}
                                </div>
                            </td>
                            <td class="small text-muted fw-normal">{{ $msg->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <span class="badge rounded-pill {{ $msg->status === 'unread' ? 'badge-unread' : 'badge-read' }} px-3 py-2 fw-semibold">
                                    {{ ucfirst($msg->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-light btn-action text-primary" title="View Message">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
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
                            <td colspan="6" class="text-center text-muted py-4">No contact messages received yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
