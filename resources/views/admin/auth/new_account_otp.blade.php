<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun Baru - Boutique Design</title>
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
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            width: 100%;
            max-width: 440px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            text-align: center;
        }

        .logo-sig {
            font-family: 'Great Vibes', cursive;
            font-size: 3rem;
            color: #c62828;
            line-height: 1;
            margin: 0;
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
        }

        .otp-icon-circle {
            width: 70px;
            height: 70px;
            background: rgba(198, 40, 40, 0.1);
            color: #c62828;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 20px auto;
        }

        .otp-input {
            letter-spacing: 12px;
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            border-radius: 14px;
            padding: 12px 16px;
            background: #ffffff;
            border: 2px solid #cbd5e1;
            color: #1e293b;
        }

        .otp-input:focus {
            border-color: #c62828;
            box-shadow: 0 0 0 4px rgba(198, 40, 40, 0.15);
        }

        .btn-verify {
            background: #c62828;
            color: #fff;
            padding: 14px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(198, 40, 40, 0.15);
            font-size: 1rem;
        }

        .btn-verify:hover {
            background: #b71c1c;
            transform: translateY(-1px);
        }

        .resend-btn {
            background: transparent;
            border: none;
            color: #c62828;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: underline;
            cursor: pointer;
            padding: 0;
        }

        .back-btn {
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-btn:hover {
            color: #c62828;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div>
            <h1 class="logo-sig">Boutique</h1>
            <span class="logo-sub">design</span>
        </div>

        <div class="otp-icon-circle">
            <i class="bi bi-shield-lock-fill"></i>
        </div>

        <h4 class="fw-bold mb-2" style="color:#1e293b;">Aktivasi Akun Baru</h4>
        <p class="text-secondary small mb-4">
            Ini adalah login pertama Anda. Silakan masukkan <strong>Kode OTP 6 Digit</strong> yang telah dikirim ke email:<br>
            <strong class="text-dark">{{ session('new_account_otp_email') ?? 'email Anda' }}</strong>
        </p>

        @if(session('error'))
            <div class="alert alert-danger border-0 rounded-3 p-3 mb-4 text-start" style="font-size: 0.88rem; background: rgba(244, 67, 54, 0.12); color: #c62828;">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 p-3 mb-4 text-start" style="font-size: 0.88rem; background: rgba(76, 175, 80, 0.12); color: #2e7d32;">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning border-0 rounded-3 p-3 mb-4 text-start" style="font-size: 0.88rem; background: rgba(255, 152, 0, 0.15); color: #b45309;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('warning') }}
            </div>
        @endif

        <form action="{{ route('admin.account.otp.verify') }}" method="POST" id="otpForm">
            @csrf
            <div class="mb-4">
                <label for="otp" class="form-label small fw-bold text-secondary text-uppercase" style="letter-spacing: 1px;">6-Digit Kode OTP</label>
                <input type="text" 
                       class="form-control otp-input @error('otp') is-invalid @enderror" 
                       id="otp" 
                       name="otp" 
                       maxlength="10" 
                       required 
                       autofocus 
                       placeholder="••••••"
                       inputmode="numeric"
                       autocomplete="one-time-code">
                @error('otp')
                    <div class="invalid-feedback text-center mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-verify mb-3">
                Aktivasi Akun & Masuk <i class="bi bi-arrow-right-circle ms-1"></i>
            </button>
        </form>

        <div class="my-3 text-secondary small">
            Belum menerima kode? 
            <form action="{{ route('admin.account.otp.resend') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="resend-btn">Kirim Ulang</button>
            </form>
        </div>

        <div class="mt-4 pt-3 border-top">
            <a href="{{ route('admin.login') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Kembali ke Login
            </a>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const otpInput = document.getElementById('otp');
        if (otpInput) {
            otpInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/\D/g, '').slice(0, 6);
            });
            otpInput.addEventListener('paste', function(e) {
                e.preventDefault();
                const pasteData = (e.clipboardData || window.clipboardData).getData('text');
                this.value = pasteData.replace(/\D/g, '').slice(0, 6);
            });
        }
    </script>
</body>
</html>
