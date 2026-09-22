@extends('admin.layout')

@section('title', 'Profil & Kelola Akun Admin')
@section('topbar_title', 'Profil & Kelola Admin')

@section('content')
<div style="max-width: 1100px;">

    {{-- Alert Messages --}}
    @if(session('admin_created_success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 p-3 mb-4 rounded-3" role="alert" style="background: rgba(76, 175, 80, 0.12); color: #2e7d32; border:none;">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span>{{ session('admin_created_success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('admin_deleted_success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 p-3 mb-4 rounded-3" role="alert" style="background: rgba(76, 175, 80, 0.12); color: #2e7d32; border:none;">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span>{{ session('admin_deleted_success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('admin_error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 p-3 mb-4 rounded-3" role="alert" style="background: rgba(244, 67, 54, 0.12); color: #c62828; border:none;">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span>{{ session('admin_error') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ROW 1: Profil Saya & Ubah Password --}}
    <div class="row g-4 mb-4">
        
        {{-- INFORMASI AKUN SAYA --}}
        <div class="col-lg-5">
            <div class="admin-card h-100">
                <h4 class="h5 fw-bold mb-3" style="color:var(--text-dark);">
                    <i class="bi bi-person-badge me-2" style="color:var(--accent-red);"></i>Profil Saya
                </h4>
                <p class="text-secondary small mb-4">Identitas akun yang saat ini aktif Anda gunakan.</p>

                @if(session('profile_success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 p-3 mb-4 rounded-3" role="alert" style="background: rgba(76, 175, 80, 0.12); color: #2e7d32; border:none;">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('profile_success') }}</span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    <div class="mb-3 text-center py-2">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle text-white shadow-sm mb-3"
                             style="width: 76px; height: 76px; background: linear-gradient(135deg, var(--accent-red), #e53935); font-size: 2rem; font-weight: 700;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="fw-bold fs-5 text-dark">{{ $user->name }}</div>
                        <div class="text-secondary small">{{ $user->email }}</div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label small fw-bold text-secondary">Alamat Email (Login)</label>
                        <input type="email" class="form-control bg-light" id="email" value="{{ $user->email }}" disabled readonly>
                        <div class="form-text small text-muted">Email ini terhubung dengan kode OTP reset password.</div>
                    </div>

                    <button type="submit" class="btn btn-outline-dark rounded-pill w-100 py-2 fw-semibold">
                        <i class="bi bi-save me-1"></i> Simpan Nama Profil
                    </button>
                </form>
            </div>
        </div>

        {{-- GANTI PASSWORD SAYA --}}
        <div class="col-lg-7">
            <div class="admin-card h-100">
                <h4 class="h5 fw-bold mb-3" style="color:var(--text-dark);">
                    <i class="bi bi-shield-lock me-2" style="color:var(--accent-red);"></i>Ubah Kata Sandi (Password)
                </h4>
                <p class="text-secondary small mb-4">
                    Ganti kata sandi akun Anda (bisa disesuaikan dengan kata sandi akun email Anda).
                </p>

                @if(session('password_success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 p-3 mb-4 rounded-3" role="alert" style="background: rgba(76, 175, 80, 0.12); color: #2e7d32; border:none;">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <span>{{ session('password_success') }}</span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf
                    
                    {{-- Kata Sandi Saat Ini --}}
                    <div class="mb-3">
                        <label for="current_password" class="form-label small fw-bold text-secondary">
                            Kata Sandi Saat Ini (Current Password)
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password" 
                                   required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePass('current_password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text small text-muted">
                            <i class="bi bi-info-circle me-1"></i>Jika belum pernah diubah, gunakan kata sandi awal: <code>admin123</code>
                        </div>
                    </div>

                    {{-- Kata Sandi Baru --}}
                    <div class="mb-3">
                        <label for="new_password" class="form-label small fw-bold text-secondary">
                            Kata Sandi Baru (New Password)
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control @error('new_password') is-invalid @enderror" 
                                   id="new_password" 
                                   name="new_password" 
                                   required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePass('new_password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Konfirmasi Kata Sandi Baru --}}
                    <div class="mb-4">
                        <label for="new_password_confirmation" class="form-label small fw-bold text-secondary">
                            Ulangi Kata Sandi Baru (Konfirmasi)
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control" 
                                   id="new_password_confirmation" 
                                   name="new_password_confirmation" 
                                   required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePass('new_password_confirmation', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-semibold" style="background:var(--accent-red); border-color:var(--accent-red);">
                            <i class="bi bi-key-fill me-1"></i> Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ROW 2: KELOLA AKUN ADMIN (DAFTAR & TAMBAH ADMIN BARU) --}}
    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="h5 fw-bold m-0" style="color:var(--text-dark);">
                    <i class="bi bi-people-fill me-2" style="color:var(--accent-red);"></i>Kelola Akun Admin
                </h4>
                <p class="text-secondary small mb-0 mt-1">Daftar admin yang memiliki hak akses ke panel ini. Tambahkan akun baru secara terkontrol di sini.</p>
            </div>
            <button class="btn btn-danger btn-sm rounded-pill px-4 py-2 fw-semibold" 
                    style="background:var(--accent-red); border-color:var(--accent-red);"
                    data-bs-toggle="modal" 
                    data-bs-target="#addAdminModal">
                <i class="bi bi-person-plus-fill me-1"></i> Tambah Akun Admin Baru
            </button>
        </div>

        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Admin</th>
                        <th>Alamat Email</th>
                        <th>Terdaftar Sejak</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $index => $adm)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $adm->name }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1 font-monospace" style="font-size: 0.85rem;">
                                    {{ $adm->email }}
                                </span>
                            </td>
                            <td class="text-secondary small">
                                {{ $adm->created_at ? $adm->created_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td>
                                @if($adm->id === Auth::id())
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                        <i class="bi bi-check-circle me-1"></i> Akun Anda
                                    </span>
                                @elseif($adm->email_verified_at)
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                        <i class="bi bi-shield-check me-1"></i> Terverifikasi
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1">
                                        <i class="bi bi-clock-history me-1"></i> Menunggu OTP
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                @if($adm->id !== Auth::id())
                                    <form action="{{ route('admin.profile.admins.destroy', $adm->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus akses admin untuk {{ $adm->name }} ({{ $adm->email }})?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-action text-danger" title="Hapus Akses Admin">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small" style="font-style: italic;">Aktif</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH ADMIN BARU --}}
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <div class="modal-header border-bottom px-4 py-3" style="background: #f8fafc;">
                <h5 class="modal-title fw-bold" id="addAdminModalLabel" style="color:#1e293b; font-size:1.1rem;">
                    <i class="bi bi-person-plus-fill me-2" style="color:var(--accent-red);"></i>Tambah Akun Admin Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('admin.profile.admins.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <p class="small text-secondary mb-3">
                        Hanya pengguna yang Anda daftarkan di sini yang dapat login ke Panel Admin Boutique Design.
                    </p>

                    <div class="mb-3">
                        <label for="admin_name" class="form-label small fw-bold text-secondary">Nama Lengkap Admin</label>
                        <input type="text" class="form-control" id="admin_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="admin_email" class="form-label small fw-bold text-secondary">Alamat Email Asli (Gmail)</label>
                        <input type="text" class="form-control" id="admin_email" name="email" required>
                        <div class="form-text small text-muted mt-1">
                            <i class="bi bi-shield-check text-success me-1"></i>Masukkan email asli aktif. Kode OTP 6-digit akan <strong>langsung dikirimkan ke Gmail ini</strong> saat Anda klik "Buat Akun Admin".
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="admin_password" class="form-label small fw-bold text-secondary">Kata Sandi Awal</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="admin_password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePass('admin_password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="admin_password_confirmation" class="form-label small fw-bold text-secondary">Konfirmasi Kata Sandi</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="admin_password_confirmation" name="password_confirmation" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePass('admin_password_confirmation', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top px-4 py-3 bg-light">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-semibold" style="background:var(--accent-red); border-color:var(--accent-red);">
                        <i class="bi bi-check-circle-fill me-1"></i> Buat Akun Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePass(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endsection
