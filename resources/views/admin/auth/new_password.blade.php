<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kata Sandi Baru - Boutique Design</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #cbd5e1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            width: 100%;
            max-width: 440px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        .logo-sig {
            font-family: 'Great Vibes', cursive;
            font-size: 3rem;
            color: #c62828;
            line-height: 1;
            margin: 0;
            text-align: center;
        }

        .logo-sub {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #2b353a;
            font-weight: 600;
            display: block;
            margin-top: -5px;
            margin-bottom: 25px;
            text-align: center;
        }

        .icon-circle {
            width: 65px;
            height: 65px;
            background: rgba(76, 175, 80, 0.12);
            color: #2e7d32;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 15px auto;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 13px 18px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            background: #fff;
            border-color: #c62828;
            box-shadow: 0 0 0 4px rgba(198, 40, 40, 0.1);
        }

        .btn-submit {
            background: #c62828;
            color: #fff;
            padding: 13px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(198, 40, 40, 0.15);
        }

        .btn-submit:hover {
            background: #b71c1c;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div>
            <h1 class="logo-sig">Boutique</h1>
            <span class="logo-sub">design</span>
        </div>

        <div class="icon-circle">
            <i class="bi bi-lock-fill"></i>
        </div>

        <h4 class="text-center fw-bold mb-2" style="color:#1e293b;">Buat Kata Sandi Baru</h4>
        <p class="text-center text-secondary small mb-4">
            Silakan masukkan kata sandi baru untuk akun admin Anda.
        </p>

        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 p-3 mb-4 text-start" style="font-size: 0.88rem; background: rgba(76, 175, 80, 0.12); color: #2e7d32;">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.password.update_new') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="password" class="form-label small fw-bold text-secondary">Kata Sandi Baru</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Minimal 6 karakter" autofocus>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('password', this)"><i class="bi bi-eye"></i></button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label small fw-bold text-secondary">Konfirmasi Kata Sandi Baru</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi kata sandi baru">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('password_confirmation', this)"><i class="bi bi-eye"></i></button>
                </div>
            </div>

            <button type="submit" class="btn-submit mb-3">
                Simpan Kata Sandi Baru <i class="bi bi-check-circle-fill ms-1"></i>
            </button>
        </form>
    </div>

    <script>
        function togglePass(id, btn) {
            const el = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (el.type === 'password') {
                el.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                el.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
