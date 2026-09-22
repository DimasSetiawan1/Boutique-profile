@extends('admin.layout')

@section('title', 'View Message')
@section('topbar_title', 'Read Message')

@section('content')
    <div class="admin-card" style="max-width: 900px;">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <div>
                <h4 class="h5 fw-bold m-0" style="color:var(--text-dark);">{{ $message->subject ?? '(No Subject)' }}</h4>
                <div class="text-muted small mt-1">Received on {{ $message->created_at->format('l, F j, Y \a\t h:i A') }}</div>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Back to Inbox
            </a>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="p-3 rounded-3 bg-light">
                    <div class="small text-muted fw-semibold uppercase mb-1">Sender Name</div>
                    <div class="fw-bold text-dark">{{ $message->name }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 rounded-3 bg-light">
                    <div class="small text-muted fw-semibold uppercase mb-1">Sender Email</div>
                    <div class="fw-bold text-dark"><a href="mailto:{{ $message->email }}" class="text-decoration-none text-dark">{{ $message->email }}</a></div>
                </div>
            </div>
            @if($message->phone)
                <div class="col-md-6">
                    <div class="p-3 rounded-3 bg-light">
                        <div class="small text-muted fw-semibold uppercase mb-1">Phone Number</div>
                        <div class="fw-bold text-dark"><a href="tel:{{ $message->phone }}" class="text-decoration-none text-dark">{{ $message->phone }}</a></div>
                    </div>
                </div>
            @endif
        </div>

        <div class="p-4 rounded-3 border bg-white mb-4" style="min-height: 200px; white-space: pre-wrap; line-height: 1.7; color:#334155;">{{ $message->message }}</div>

        <div class="d-flex gap-3">
            <a href="mailto:{{ $message->email }}?subject=RE: {{ rawurlencode($message->subject ?? 'Inquiry') }}" class="btn btn-danger rounded-pill px-4" style="background-color:var(--accent-red); border-color:var(--accent-red);">
                <i class="bi bi-reply-fill me-1"></i> Reply via Email
            </a>
            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                    <i class="bi bi-trash-fill me-1"></i> Delete Message
                </button>
            </form>
        </div>
    </div>
@endsection
