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
            height: 100dvh;
            max-height: 100vh;
            max-height: 100dvh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 1050;
            transition: var(--transition);
            overflow-y: auto;
            overflow-x: hidden;
            overscroll-behavior: contain;
            -webkit-overflow-scrolling: touch;
            touch-action: pan-y;
        }

        /* Sleek custom scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .sidebar-header {
            padding: 26px 22px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            flex-shrink: 0;
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
            padding: 18px 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-menu li {
            margin-bottom: 4px;
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
            padding-bottom: max(24px, env(safe-area-inset-bottom, 24px));
            border-top: 1px solid rgba(255,255,255,0.05);
            flex-shrink: 0;
            background-color: #0f172a;
            margin-top: auto;
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
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
            width: calc(100% - var(--sidebar-width));
            overscroll-behavior: contain;
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
                left: -280px;
                width: 280px;
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
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
            .sidebar-backdrop {
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, 0.65);
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                z-index: 1040;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }
            .sidebar-backdrop.active {
                opacity: 1;
                visibility: visible;
            }
            body.sidebar-open {
                overflow: hidden !important;
                touch-action: none;
            }
            body.sidebar-open .sidebar {
                touch-action: pan-y;
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
            <div class="sidebar-brand d-block" style="cursor: default; user-select: none;">
                <img src="{{ asset('uploads/logo.png') }}" alt="Boutique Design" style="height: 48px; width: auto; filter: brightness(0) invert(1); pointer-events: none; user-select: none;">
            </div>
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

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

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
            const backdrop = document.getElementById('sidebarBackdrop');
            
            function openSidebar() {
                sidebar.classList.add('active');
                if (backdrop) backdrop.classList.add('active');
                document.body.classList.add('sidebar-open');
            }

            function closeSidebar() {
                sidebar.classList.remove('active');
                if (backdrop) backdrop.classList.remove('active');
                document.body.classList.remove('sidebar-open');
            }

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (sidebar.classList.contains('active')) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                });
                
                if (backdrop) {
                    backdrop.addEventListener('click', closeSidebar);
                }

                document.addEventListener('click', function(e) {
                    if (sidebar.classList.contains('active') && !sidebar.contains(e.target) && e.target !== toggleBtn) {
                        closeSidebar();
                    }
                });

                // Close on ESC key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                        closeSidebar();
                    }
                });

                // Auto-close on link click when on mobile screen
                sidebar.querySelectorAll('.sidebar-link').forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth <= 991) {
                            closeSidebar();
                        }
                    });
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

    <!-- Modal System Popup ("Pop Up Oke") -->
    <div class="modal fade" id="systemPopupModal" tabindex="-1" aria-labelledby="systemPopupTitle" aria-hidden="true" style="z-index: 10999;">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-center p-4" style="background: #ffffff;">
                <div class="d-flex justify-content-center mb-3">
                    <div id="systemPopupIconBox" class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 78px; height: 78px; background: rgba(16, 185, 129, 0.12); border: 2px solid rgba(16, 185, 129, 0.25); transition: all 0.3s ease;">
                        <i id="systemPopupIcon" class="bi bi-check-circle-fill text-success" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-2" id="systemPopupTitle">Berhasil!</h4>
                <p class="text-secondary small mb-4 px-2" id="systemPopupMessage" style="line-height: 1.6; font-size: 0.95rem;">Tindakan Anda telah berhasil diproses.</p>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-dark rounded-pill px-5 py-2.5 fw-bold shadow-sm" id="systemPopupBtn" data-bs-dismiss="modal" style="min-width: 150px; font-size: 0.95rem; letter-spacing: 0.3px;">
                        Oke
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal System Confirm ("Pop Up Konfirmasi Hapus") -->
    <div class="modal fade" id="systemConfirmModal" tabindex="-1" aria-labelledby="systemConfirmTitle" aria-hidden="true" style="z-index: 10999;">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-center p-4" style="background: #ffffff;">
                <div class="d-flex justify-content-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 78px; height: 78px; background: rgba(225, 29, 72, 0.12); border: 2px solid rgba(225, 29, 72, 0.25);">
                        <i class="bi bi-trash3-fill text-danger" style="font-size: 2.3rem;"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-2" id="systemConfirmTitle">Konfirmasi Hapus</h4>
                <p class="text-secondary small mb-4 px-2" id="systemConfirmMessage" style="line-height: 1.6; font-size: 0.95rem;">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-4 py-2 fw-semibold text-secondary border" data-bs-dismiss="modal" style="min-width: 110px;">
                        Batal
                    </button>
                    <button type="button" class="btn btn-danger rounded-pill px-4 py-2 fw-bold shadow-sm" id="systemConfirmProceedBtn" style="background-color: var(--accent-red); border-color: var(--accent-red); min-width: 120px;">
                        <i class="bi bi-trash3 me-1"></i> Ya, Hapus!
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- System Popups & Confirmation Interceptor Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Global System Alert ("Pop Up Oke")
            window.systemAlert = function(message, title = 'Berhasil!', type = 'success', btnText = 'Oke') {
                const modalEl = document.getElementById('systemPopupModal');
                if (!modalEl || typeof bootstrap === 'undefined') return;
                
                const titleEl = document.getElementById('systemPopupTitle');
                const msgEl = document.getElementById('systemPopupMessage');
                const iconBox = document.getElementById('systemPopupIconBox');
                const iconEl = document.getElementById('systemPopupIcon');
                const btnEl = document.getElementById('systemPopupBtn');

                if (titleEl) titleEl.textContent = title;
                if (msgEl) msgEl.innerHTML = message;
                if (btnEl) btnEl.textContent = btnText;

                if (iconBox && iconEl) {
                    if (type === 'success') {
                        iconBox.style.background = 'rgba(16, 185, 129, 0.12)';
                        iconBox.style.border = '2px solid rgba(16, 185, 129, 0.25)';
                        iconEl.className = 'bi bi-check-circle-fill text-success';
                        btnEl.className = 'btn btn-dark rounded-pill px-5 py-2.5 fw-bold shadow-sm';
                        btnEl.style.backgroundColor = '';
                        btnEl.style.borderColor = '';
                    } else if (type === 'error') {
                        iconBox.style.background = 'rgba(239, 68, 68, 0.12)';
                        iconBox.style.border = '2px solid rgba(239, 68, 68, 0.25)';
                        iconEl.className = 'bi bi-exclamation-triangle-fill text-danger';
                        btnEl.className = 'btn btn-danger rounded-pill px-5 py-2.5 fw-bold shadow-sm';
                        btnEl.style.backgroundColor = 'var(--accent-red)';
                        btnEl.style.borderColor = 'var(--accent-red)';
                    } else {
                        iconBox.style.background = 'rgba(59, 130, 246, 0.12)';
                        iconBox.style.border = '2px solid rgba(59, 130, 246, 0.25)';
                        iconEl.className = 'bi bi-info-circle-fill text-primary';
                        btnEl.className = 'btn btn-primary rounded-pill px-5 py-2.5 fw-bold shadow-sm';
                        btnEl.style.backgroundColor = '';
                        btnEl.style.borderColor = '';
                    }
                }

                const bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
                bsModal.show();
                setTimeout(() => { if (btnEl) btnEl.focus(); }, 250);
            };

            // Global System Confirm ("Pop Up Konfirmasi Hapus")
            let pendingConfirmAction = null;
            window.systemConfirm = function(message, onConfirm, title = 'Konfirmasi Hapus', confirmBtnText = 'Ya, Hapus!') {
                const modalEl = document.getElementById('systemConfirmModal');
                if (!modalEl || typeof bootstrap === 'undefined') {
                    if (confirm(message)) onConfirm();
                    return;
                }
                const titleEl = document.getElementById('systemConfirmTitle');
                const msgEl = document.getElementById('systemConfirmMessage');
                const proceedBtn = document.getElementById('systemConfirmProceedBtn');

                if (titleEl) titleEl.textContent = title;
                if (msgEl) msgEl.textContent = message;
                if (proceedBtn) proceedBtn.innerHTML = `<i class="bi bi-trash3 me-1"></i> ${confirmBtnText}`;

                pendingConfirmAction = onConfirm;

                const bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
                bsModal.show();
            };

            document.getElementById('systemConfirmProceedBtn')?.addEventListener('click', function() {
                const modalEl = document.getElementById('systemConfirmModal');
                const bsModal = bootstrap.Modal.getInstance(modalEl);
                if (bsModal) bsModal.hide();
                if (typeof pendingConfirmAction === 'function') {
                    const action = pendingConfirmAction;
                    pendingConfirmAction = null;
                    action();
                }
            });

            // Intercept all native browser confirm() on forms & buttons across ALL admin pages
            function bindConfirmInterceptors() {
                // 1. Intercept forms with onsubmit="return confirm(...)"
                document.querySelectorAll('form[onsubmit*="confirm"]').forEach(form => {
                    const rawAttr = form.getAttribute('onsubmit') || '';
                    const match = rawAttr.match(/confirm\s*\(\s*['"`](.*?)['"`]\s*\)/);
                    const msg = match ? match[1] : 'Apakah Anda yakin ingin menghapus data ini?';
                    
                    form.removeAttribute('onsubmit');
                    form.addEventListener('submit', function(e) {
                        if (!form.dataset.confirmed) {
                            e.preventDefault();
                            e.stopPropagation();
                            window.systemConfirm(msg, function() {
                                form.dataset.confirmed = "true";
                                form.submit();
                            });
                            return false;
                        }
                    });
                });

                // 2. Intercept buttons or links with onclick containing confirm(...)
                document.querySelectorAll('button[onclick*="confirm"], a[onclick*="confirm"]').forEach(el => {
                    const rawAttr = el.getAttribute('onclick') || '';
                    const match = rawAttr.match(/confirm\s*\(\s*['"`](.*?)['"`]\s*\)/);
                    const msg = match ? match[1] : 'Apakah Anda yakin ingin menghapus item ini?';
                    
                    el.removeAttribute('onclick');
                    el.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        window.systemConfirm(msg, function() {
                            const parentForm = el.closest('form');
                            if (parentForm) {
                                parentForm.dataset.confirmed = "true";
                                parentForm.submit();
                            }
                        });
                    });
                });
            }

            bindConfirmInterceptors();

            // Auto-trigger System Popup Oke on Session Flash
            @if(session('success'))
                window.systemAlert(@json(session('success')), 'Berhasil!', 'success', 'Oke');
            @endif

            @if(session('error'))
                window.systemAlert(@json(session('error')), 'Perhatian', 'error', 'Oke, Mengerti');
            @endif
        });
    </script>
</body>
</html>
