<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Boutique Design Indonesia</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-dashboard: #f1f5f9;
            --sidebar-width: 260px;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --accent-red: #c62828;
            --white: #ffffff;
            --shadow: 0 4px 20px rgba(0,0,0,0.03);
            --transition: all 0.25s ease;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-dashboard);
            color: var(--text-dark);
            min-height: 100vh;
            margin: 0;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: #0f172a; /* Midnight Blue Slate */
            color: #94a3b8;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 30px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-brand .logo-sig {
            font-family: 'Great Vibes', cursive;
            font-size: 2.3rem;
            color: var(--white);
            line-height: 1;
            margin: 0;
            display: block;
        }

        .sidebar-brand .logo-sub {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #64748b;
            font-weight: 600;
            display: block;
            margin-top: -3px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 24px 0;
            margin: 0;
            flex-grow: 1;
            overflow-y: auto;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 24px;
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
            border-left: 4px solid transparent;
        }

        .sidebar-link:hover, .sidebar-link.active {
            color: var(--white);
            background: rgba(255,255,255,0.03);
            border-left-color: var(--accent-red);
        }

        .sidebar-link i {
            font-size: 1.15rem;
        }

        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .btn-logout-sidebar {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #94a3b8;
            background: none;
            border: none;
            padding: 10px 0;
            font-weight: 500;
            width: 100%;
            text-align: left;
            transition: var(--transition);
        }

        .btn-logout-sidebar:hover {
            color: #f43f5e;
        }

        /* Main Content Container */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            width: calc(100% - var(--sidebar-width));
        }

        /* Top Bar */
        .topbar {
            height: 70px;
            background-color: var(--white);
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .topbar-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-dark);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        .topbar-user-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background-color: #e2e8f0;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        /* Content Container */
        .content-body {
            padding: 40px;
            flex-grow: 1;
        }

        /* Styling helper classes */
        .admin-card {
            background-color: var(--white);
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: var(--shadow);
            padding: 30px;
            margin-bottom: 30px;
        }

        .admin-table {
            vertical-align: middle;
        }

        .admin-table th {
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 15px 20px;
            border-bottom: 2px solid #e2e8f0;
        }

        .admin-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: var(--transition);
        }

        .badge-read {
            background-color: #e2e8f0;
            color: #475569;
        }

        .badge-unread {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        /* Responsive */
        @media(max-width: 991px) {
            .sidebar {
                left: -260px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-wrapper {
                margin-left: 0;
                width: 100%;
            }
            .topbar {
                padding: 0 20px;
            }
            .content-body {
                padding: 20px;
            }
        }

        /* Auto-Translate Styles */
        @keyframes spinAnim {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .spin-anim {
            display: inline-block;
            animation: spinAnim 0.75s linear infinite;
        }
        .auto-translate-badge {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            font-size: 0.72rem !important;
            padding: 3px 10px;
            border-radius: 20px;
            user-select: none;
            display: inline-flex;
            align-items: center;
            vertical-align: middle;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #475569;
            font-weight: 500;
        }
        .auto-translate-badge:hover {
            background-color: #eff6ff !important;
            border-color: #3b82f6 !important;
            color: #1d4ed8 !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(59, 130, 246, 0.15);
        }
        .field-translated-flash {
            border-color: #22c55e !important;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.25) !important;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <a class="sidebar-brand text-decoration-none d-block" href="{{ route('home') }}" target="_blank">
                <img src="{{ asset('uploads/logo.png') }}" alt="Boutique Design " style="height: 48px; width: auto; filter: brightness(0) invert(1);">
            </a>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.philosophies.index') }}" class="sidebar-link {{ Route::is('admin.philosophies.*') ? 'active' : '' }}">
                    <i class="bi bi-lightbulb"></i>
                    <span>Philosophy</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ Route::is('admin.services.*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i>
                    <span>Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.portfolios.index') }}" class="sidebar-link {{ Route::is('admin.portfolios.*') ? 'active' : '' }}">
                    <i class="bi bi-collection"></i>
                    <span>Portfolio</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.clients.index') }}" class="sidebar-link {{ Route::is('admin.clients.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i>
                    <span>Clients</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.team.index') }}" class="sidebar-link {{ Route::is('admin.team.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Team Members</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ Route::is('admin.messages.*') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    <span>Inbox Messages</span>
                    @php
                        $unreadCount = \App\Models\ContactMessage::where('status', 'unread')->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="badge rounded-pill bg-danger ms-auto" style="font-size:0.75rem;">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ Route::is('admin.settings.*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.profile.index') }}" class="sidebar-link {{ Route::is('admin.profile.*') ? 'active' : '' }}">
                    <i class="bi bi-person-gear"></i>
                    <span>Profile & Password</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Bar -->
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h2 class="topbar-title">@yield('topbar_title', 'Overview')</h2>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3" target="_blank">
                    <i class="bi bi-globe me-1"></i> Visit Website
                </a>
                <a href="{{ route('admin.profile.index') }}" class="topbar-user text-decoration-none" title="Kelola Profil & Password">
                    <span class="d-none d-sm-inline">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    <div class="topbar-user-icon"><i class="bi bi-person-fill"></i></div>
                </a>
            </div>
        </header>

        <!-- Content Body -->
        <main class="content-body">
            @if(!is_writable(public_path('uploads')))
                <div class="alert alert-warning d-flex flex-wrap align-items-center justify-content-between p-3 mb-4 rounded-3 border-0 shadow-sm" role="alert" style="background: rgba(245, 158, 11, 0.15); color: #b45309;">
                    <div class="d-flex align-items-center mb-2 mb-md-0 me-3">
                        <i class="bi bi-shield-exclamation me-2 fs-5 text-warning"></i>
                        <span><strong>Peringatan Izin Folder Server:</strong> Folder <code>public/uploads</code> tidak dapat ditulis oleh web server. Upload foto tim, clients, dan filosofi akan gagal sebelum izin folder dibuka.</span>
                    </div>
                    <form action="{{ route('admin.settings.fix_permissions') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm text-dark fw-bold rounded-pill px-3 shadow-sm">
                            <i class="bi bi-wrench me-1"></i> Perbaiki Izin Otomatis
                        </button>
                    </form>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 p-3 mb-4" role="alert" style="background: rgba(76, 175, 80, 0.12); color: #2e7d32;">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 p-3 mb-4" role="alert" style="background: rgba(244, 67, 54, 0.12); color: #c62828;">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('adminSidebar');
            
            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    sidebar.classList.toggle('active');
                });
                
                document.addEventListener('click', function(e) {
                    if (sidebar.classList.contains('active') && !sidebar.contains(e.target) && e.target !== toggleBtn) {
                        sidebar.classList.remove('active');
                    }
                });
            }

            // ==========================================
            // AUTO-TRANSLATE: INDONESIAN TO ENGLISH
            // ==========================================
            const translateUrl = "{{ route('admin.translate') }}";
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            document.querySelectorAll('form').forEach(form => {
                // Find all fields ending with _id (Indonesian fields)
                const idElements = form.querySelectorAll('input[name$="_id"], textarea[name$="_id"], input[id$="_id"], textarea[id$="_id"]');

                idElements.forEach(idEl => {
                    const idName = idEl.getAttribute('name') || idEl.getAttribute('id');
                    if (!idName) return;

                    const enName = idName.replace(/_id$/, '_en');
                    const enEl = form.querySelector(`input[name="${enName}"], textarea[name="${enName}"], #${enName}`);
                    if (!enEl) return;

                    // Locate or find the label for English field
                    const enLabel = form.querySelector(`label[for="${enEl.id || enName}"]`) || enEl.closest('.col-md-6, .col-12, .mb-3, .mb-4')?.querySelector('label');
                    
                    let badge = null;
                    if (enLabel && !enLabel.querySelector('.auto-translate-badge')) {
                        badge = document.createElement('span');
                        badge.className = 'auto-translate-badge badge ms-2';
                        badge.innerHTML = '<i class="bi bi-translate text-primary me-1"></i>Auto-Translate';
                        badge.title = 'Terjemahkan otomatis dari input Bahasa Indonesia';
                        enLabel.appendChild(badge);
                    }

                    let debounceTimer = null;
                    let lastTranslatedText = idEl.value.trim();

                    async function executeTranslation(force = false) {
                        const currentText = idEl.value.trim();
                        if (!currentText) {
                            return;
                        }

                        // Don't re-translate if same text unless forced (clicked badge)
                        if (!force && currentText === lastTranslatedText) {
                            return;
                        }

                        if (badge) {
                            badge.className = 'auto-translate-badge badge bg-warning-subtle text-dark border border-warning ms-2';
                            badge.innerHTML = '<i class="bi bi-arrow-repeat spin-anim text-warning me-1"></i>Menerjemahkan...';
                        }

                        try {
                            const res = await fetch(translateUrl, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    text: currentText,
                                    from: 'id',
                                    to: 'en'
                                })
                            });

                            const data = await res.json();
                            if (data.success && data.translated) {
                                enEl.value = data.translated;
                                lastTranslatedText = currentText;

                                // Visual flash highlight on the English field
                                enEl.classList.add('field-translated-flash');
                                setTimeout(() => {
                                    enEl.classList.remove('field-translated-flash');
                                }, 1200);

                                if (badge) {
                                    badge.className = 'auto-translate-badge badge bg-success-subtle text-success border border-success ms-2';
                                    badge.innerHTML = '<i class="bi bi-check2-circle me-1"></i>Otomatis Terisi';
                                    setTimeout(() => {
                                        badge.className = 'auto-translate-badge badge ms-2';
                                        badge.innerHTML = '<i class="bi bi-translate text-primary me-1"></i>Auto-Translate';
                                    }, 2500);
                                }

                                // Trigger input event for any listeners
                                enEl.dispatchEvent(new Event('input', { bubbles: true }));
                            } else if (badge) {
                                badge.className = 'auto-translate-badge badge ms-2';
                                badge.innerHTML = '<i class="bi bi-translate text-primary me-1"></i>Auto-Translate';
                            }
                        } catch (err) {
                            console.error('Auto-translate error:', err);
                            if (badge) {
                                badge.className = 'auto-translate-badge badge ms-2';
                                badge.innerHTML = '<i class="bi bi-translate text-primary me-1"></i>Auto-Translate';
                            }
                        }
                    }

                    // Auto-translate on input (debounce 650ms while typing)
                    idEl.addEventListener('input', function() {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            executeTranslation(false);
                        }, 650);
                    });

                    // Auto-translate on change / blur
                    idEl.addEventListener('change', function() {
                        clearTimeout(debounceTimer);
                        executeTranslation(false);
                    });

                    // Manual trigger when clicking the badge
                    if (badge) {
                        badge.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            clearTimeout(debounceTimer);
                            executeTranslation(true);
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
