@extends('admin.layout')

@section('title', 'Dashboard')
@section('topbar_title', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <!-- Stat Cards -->
        <div class="col-sm-6 col-xl-3">
            <div class="admin-card h-100 d-flex flex-column justify-content-between p-4" style="position:relative; overflow:hidden;">
                <div>
                    <h5 class="text-secondary small fw-bold text-uppercase mb-2">Philosophy Items</h5>
                    <h3 class="display-6 fw-bold m-0" style="color:var(--text-dark);">{{ $stats['philosophies'] }}</h3>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.philosophies.index') }}" class="small text-decoration-none fw-semibold" style="color:var(--accent-red);">
                        Manage Philosophy <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <i class="bi bi-lightbulb text-secondary opacity-25" style="font-size:4rem; position:absolute; bottom:-10px; right:15px;"></i>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="admin-card h-100 d-flex flex-column justify-content-between p-4" style="position:relative; overflow:hidden;">
                <div>
                    <h5 class="text-secondary small fw-bold text-uppercase mb-2">Total Services</h5>
                    <h3 class="display-6 fw-bold m-0" style="color:var(--text-dark);">{{ $stats['services'] }}</h3>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.services.index') }}" class="small text-decoration-none fw-semibold" style="color:var(--accent-red);">
                        Manage Services <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <i class="bi bi-briefcase text-secondary opacity-25" style="font-size:4rem; position:absolute; bottom:-10px; right:15px;"></i>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="admin-card h-100 d-flex flex-column justify-content-between p-4" style="position:relative; overflow:hidden;">
                <div>
                    <h5 class="text-secondary small fw-bold text-uppercase mb-2">Portfolio Items</h5>
                    <h3 class="display-6 fw-bold m-0" style="color:var(--text-dark);">{{ $stats['portfolios'] }}</h3>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.portfolios.index') }}" class="small text-decoration-none fw-semibold" style="color:var(--accent-red);">
                        Manage Portfolios <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <i class="bi bi-collection text-secondary opacity-25" style="font-size:4rem; position:absolute; bottom:-10px; right:15px;"></i>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="admin-card h-100 d-flex flex-column justify-content-between p-4" style="position:relative; overflow:hidden;">
                <div>
                    <h5 class="text-secondary small fw-bold text-uppercase mb-2">Team Members</h5>
                    <h3 class="display-6 fw-bold m-0" style="color:var(--text-dark);">{{ $stats['team_members'] }}</h3>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.team.index') }}" class="small text-decoration-none fw-semibold" style="color:var(--accent-red);">
                        Manage Team <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <i class="bi bi-people text-secondary opacity-25" style="font-size:4rem; position:absolute; bottom:-10px; right:15px;"></i>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="admin-card h-100 d-flex flex-column justify-content-between p-4" style="position:relative; overflow:hidden;">
                <div>
                    <h5 class="text-secondary small fw-bold text-uppercase mb-2">Inbox Messages</h5>
                    <h3 class="display-6 fw-bold m-0 d-flex align-items-center gap-2" style="color:var(--text-dark);">
                        {{ $stats['messages_total'] }}
                        @if($stats['messages_unread'] > 0)
                            <span class="badge bg-danger rounded-pill fs-6" style="padding: 6px 12px;">{{ $stats['messages_unread'] }} Unread</span>
                        @endif
                    </h3>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.messages.index') }}" class="small text-decoration-none fw-semibold" style="color:var(--accent-red);">
                        View Messages <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <i class="bi bi-envelope text-secondary opacity-25" style="font-size:4rem; position:absolute; bottom:-10px; right:15px;"></i>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Messages -->
        <div class="col-xl-8">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="h5 fw-bold m-0" style="color:var(--text-dark);">Recent Messages</h4>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">View All Inbox</a>
                </div>

                <div class="table-responsive">
                    <table class="table admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Received</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMessages as $msg)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $msg->name }}</div>
                                        <div class="small text-muted">{{ $msg->email }}</div>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 200px;">{{ $msg->subject ?? '(No Subject)' }}</div>
                                    </td>
                                    <td class="small text-muted">{{ $msg->created_at->diffForHumans() }}</td>
                                    <td>
                                        <span class="badge rounded-pill {{ $msg->status === 'unread' ? 'badge-unread' : 'badge-read' }} px-3 py-2">
                                            {{ ucfirst($msg->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-light btn-action text-primary" title="View Message">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No contact messages received yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Info Panel -->
        <div class="col-xl-4">
            <div class="admin-card">
                <h4 class="h5 fw-bold mb-4" style="color:var(--text-dark);">System Status</h4>
                
                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center p-3 rounded-3" style="background:#f8fafc; border:1px solid #e2e8f0;">
                        <span class="small text-muted">Laravel Version</span>
                        <span class="fw-bold small">8.83.29</span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center p-3 rounded-3" style="background:#f8fafc; border:1px solid #e2e8f0;">
                        <span class="small text-muted">PHP Version</span>
                        <span class="fw-bold small">{{ PHP_VERSION }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center p-3 rounded-3" style="background:#f8fafc; border:1px solid #e2e8f0;">
                        <span class="small text-muted">Database Server</span>
                        <span class="fw-bold small text-success"><i class="bi bi-check-circle-fill me-1"></i> MySQL Connected</span>
                    </div>
                </div>

                <div class="p-3 rounded-3" style="background: rgba(198, 40, 40, 0.05); border: 1px dashed rgba(198, 40, 40, 0.25);">
                    <h5 class="fw-bold text-danger mb-2" style="font-size:0.95rem;"><i class="bi bi-info-circle me-1"></i> Quick Tips</h5>
                    <p class="small text-muted m-0" style="line-height:1.6;">
                        You can update the address, phone numbers, email, NPWP, and main/sub slogans on the website under the **Settings** manager. Any changes made will reflect instantly on the public website.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
