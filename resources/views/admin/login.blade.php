<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Boutique Design Indonesia</title>
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
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            width: 100%;
            max-width: 440px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
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
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 14px 20px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: #fff;
            border-color: #c62828;
            box-shadow: 0 0 0 4px rgba(198, 40, 40, 0.1);
        }

        .btn-login {
            background: #c62828;
            color: #fff;
            padding: 14px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(198, 40, 40, 0.15);
        }

        .btn-login:hover {
            background: #b71c1c;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(198, 40, 40, 0.25);
        }

        .back-btn {
            color: #546e7a;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-btn:hover {
            color: #c62828;
        }

        .input-group .form-control {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .btn-eye-addon {
            background: #f8fafc;
            border: 1px solid #ced4da;
            border-left: 1px solid #cbd5e1;
            border-top-right-radius: 12px !important;
            border-bottom-right-radius: 12px !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            padding: 0 16px;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .btn-eye-addon:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .input-group:focus-within .form-control {
            border-color: #c62828;
            box-shadow: none;
            background: #fff;
        }

        .input-group:focus-within .btn-eye-addon {
            border-color: #c62828;
            background: #ffffff;
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

        <h4 class="text-center fw-bold mb-4" style="color:#2b353a;">Admin Panel Login</h4>

        @if(session('error'))
            <div class="alert alert-danger border-0 rounded-3 p-3 mb-4" style="font-size: 0.9rem; background: rgba(244, 67, 54, 0.12); color: #c62828;">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 p-3 mb-4" style="font-size: 0.9rem; background: rgba(76, 175, 80, 0.12); color: #2e7d32;">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="email" class="form-label small fw-bold text-secondary mb-0">Email Address</label>
                    <span id="emailBadge" class="small fw-semibold" style="display: none; transition: all 0.2s;"></span>
                </div>
                <div class="position-relative">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email harus valid!" style="padding-right: 44px;">
                    <span id="emailSpinner" class="spinner-border spinner-border-sm text-secondary" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); display: none;" role="status"></span>
                    <span id="emailIcon" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); display: none;"></span>
                </div>
                <div id="emailFeedbackMsg" class="small mt-1 fw-medium" style="display: none; font-size: 0.84rem;"></div>
                @error('email')
                    @php
                        $isLockout = preg_match('/(\d+)\s*detik/i', $message, $m);
                        $lockoutSec = $isLockout ? (int)$m[1] : (session('lockout_seconds') ?? null);
                    @endphp

                    @if($isLockout)
                        <div class="alert alert-danger border-0 rounded-4 p-3 mt-3 text-start shadow-sm" id="lockoutAlertBox" style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid #ef4444 !important;">
                            <div class="d-flex align-items-center gap-2 mb-1.5">
                                <span class="spinner-grow spinner-grow-sm text-danger" role="status"></span>
                                <strong class="small fw-bold text-danger">Akses Login Sementara Ditangguhkan</strong>
                            </div>
                            <p class="small text-secondary mb-2" style="line-height: 1.5;">
                                Terdeteksi 3x salah memasukkan kata sandi. Waktu tunggu blokir:
                            </p>
                            <div class="d-flex align-items-center gap-2 my-2 py-1 px-3 bg-white rounded-pill border shadow-sm d-inline-flex" id="timerBadge">
                                <i class="bi bi-clock-history text-danger fs-5"></i>
                                <span class="fs-5 fw-bold text-danger font-monospace" id="liveCountdownFormatted">00:00</span>
                                <span class="small fw-bold text-secondary">(<span id="liveCountdownTimer">{{ $lockoutSec }}</span>s tersisa)</span>
                            </div>
                            <div class="small text-muted mt-2" id="lockoutSubText">
                                Harap tunggu hingga hitungan mundur selesai. Kode OTP dari Gmail belum dikirimkan dan baru akan dikirimkan otomatis setelah waktu blokir berakhir.
                            </div>
                        </div>
                    @else
                        <div class="invalid-feedback d-block text-start mt-1">{{ $message }}</div>
                    @endif
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label small fw-bold text-secondary">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    <button class="btn btn-eye-addon" type="button" id="togglePasswordBtn" title="Tampilkan / Sembunyikan Kata Sandi" aria-label="Lihat kata sandi">
                        <i class="bi bi-eye" id="togglePasswordIcon" style="font-size: 1.15rem;"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label small text-secondary" for="remember">Remember me</label>
                </div>
                <a href="{{ route('admin.password.forgot') }}" class="small text-danger text-decoration-none fw-semibold">Lupa Kata Sandi?</a>
            </div>

            <button type="submit" class="btn-login mb-4">Log In <i class="bi bi-box-arrow-in-right ms-1"></i></button>

            <div class="text-center">
                <a href="{{ route('home') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Back to Homepage</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Password Show/Hide
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                toggleIcon.classList.toggle('bi-eye', !isPassword);
                toggleIcon.classList.toggle('bi-eye-slash', isPassword);
            });
        }

        // Live Email Validation
        let debounceTimeout = null;
        const emailInput = document.getElementById('email');
        const emailBadge = document.getElementById('emailBadge');
        const emailFeedbackMsg = document.getElementById('emailFeedbackMsg');
        const emailIcon = document.getElementById('emailIcon');
        const emailSpinner = document.getElementById('emailSpinner');

        function checkEmailLive() {
            const val = emailInput.value.trim();
            if (!val) {
                resetEmailValidation();
                return;
            }

            emailSpinner.style.display = 'block';
            emailIcon.style.display = 'none';

            fetch("{{ route('admin.check_email') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ email: val })
            })
            .then(res => res.json())
            .then(data => {
                emailSpinner.style.display = 'none';
                if (data.status === 'valid') {
                    emailBadge.style.display = 'inline-block';
                    emailBadge.innerHTML = `<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i>${data.badge}</span>`;
                    emailFeedbackMsg.style.display = 'block';
                    emailFeedbackMsg.innerHTML = `<span class="text-success"><i class="bi bi-check2-circle me-1"></i>${data.message}</span>`;
                    emailIcon.style.display = 'block';
                    emailIcon.innerHTML = `<i class="bi bi-check-circle-fill text-success" style="font-size: 1.15rem;"></i>`;
                    emailInput.style.borderColor = '#198754';
                    emailInput.style.boxShadow = '0 0 0 4px rgba(25, 135, 84, 0.15)';
                    emailInput.style.background = '#ffffff';
                } else if (data.status === 'not_found' || data.status === 'invalid_format') {
                    emailBadge.style.display = 'inline-block';
                    emailBadge.innerHTML = `<span class="text-danger"><i class="bi bi-x-circle-fill me-1"></i>${data.badge}</span>`;
                    emailFeedbackMsg.style.display = 'block';
                    emailFeedbackMsg.innerHTML = `<span class="text-danger"><i class="bi bi-exclamation-circle-fill me-1"></i>${data.message}</span>`;
                    emailIcon.style.display = 'block';
                    emailIcon.innerHTML = `<i class="bi bi-x-circle-fill text-danger" style="font-size: 1.15rem;"></i>`;
                    emailInput.style.borderColor = '#dc3545';
                    emailInput.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.15)';
                    emailInput.style.background = '#ffffff';
                } else {
                    resetEmailValidation();
                }
            })
            .catch(() => {
                emailSpinner.style.display = 'none';
            });
        }

        function resetEmailValidation() {
            emailBadge.style.display = 'none';
            emailFeedbackMsg.style.display = 'none';
            emailIcon.style.display = 'none';
            emailSpinner.style.display = 'none';
            emailInput.style.borderColor = '';
            emailInput.style.boxShadow = '';
            emailInput.style.background = '';
        }

        if (emailInput) {
            emailInput.addEventListener('input', function() {
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(checkEmailLive, 400);
            });

            emailInput.addEventListener('blur', function() {
                clearTimeout(debounceTimeout);
                checkEmailLive();
            });

            if (emailInput.value.trim().length > 0) {
                checkEmailLive();
            }
        }

        // Active Real-Time Countdown Timer for Lockout (Hitungan Waktu Berjalan Mundur)
        function initLockoutCountdown() {
            let timerEl = document.getElementById('liveCountdownTimer');
            const loginBtn = document.querySelector('.btn-login');

            // Fallback: If timerEl is not present yet, check if there is an error message mentioning lockout seconds
            if (!timerEl) {
                const feedbackEls = document.querySelectorAll('.invalid-feedback');
                feedbackEls.forEach(el => {
                    const match = el.textContent.match(/diblokir selama (\d+) detik/i);
                    if (match) {
                        const sec = parseInt(match[1], 10);
                        el.innerHTML = `
                            <div class="alert alert-danger border-0 rounded-4 p-3 mt-3 text-start shadow-sm" id="lockoutAlertBox" style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid #ef4444 !important;">
                                <div class="d-flex align-items-center gap-2 mb-1.5">
                                    <span class="spinner-grow spinner-grow-sm text-danger" role="status"></span>
                                    <strong class="small fw-bold text-danger">Akses Login Sementara Ditangguhkan</strong>
                                </div>
                                <p class="small text-secondary mb-2" style="line-height: 1.5;">
                                    Terdeteksi 3x salah memasukkan kata sandi. Waktu tunggu blokir:
                                </p>
                                <div class="d-flex align-items-center gap-2 my-2 py-1 px-3 bg-white rounded-pill border shadow-sm d-inline-flex" id="timerBadge">
                                    <i class="bi bi-clock-history text-danger fs-5"></i>
                                    <span class="fs-5 fw-bold text-danger font-monospace" id="liveCountdownTimer">${sec}</span>
                                    <span class="small fw-bold text-secondary">detik tersisa</span>
                                </div>
                                <div class="small text-muted mt-2" id="lockoutSubText">
                                    Silakan gunakan kode OTP yang telah dikirim ke email Anda untuk memulihkan akun, atau tunggu hingga hitungan mundur selesai.
                                </div>
                            </div>
                        `;
                    }
                });
                timerEl = document.getElementById('liveCountdownTimer');
            }

            function formatLockoutTime(totalSec) {
                if (totalSec <= 0) return '00:00';
                const hours = Math.floor(totalSec / 3600);
                const minutes = Math.floor((totalSec % 3600) / 60);
                const seconds = totalSec % 60;
                const pad = (n) => String(n).padStart(2, '0');
                if (hours > 0) {
                    return `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
                }
                return `${pad(minutes)}:${pad(seconds)}`;
            }

            const formattedEl = document.getElementById('liveCountdownFormatted');

            if (timerEl) {
                let secondsLeft = parseInt(timerEl.textContent.trim(), 10) || 0;

                if (secondsLeft > 0) {
                    if (formattedEl) {
                        formattedEl.textContent = formatLockoutTime(secondsLeft);
                    }

                    if (loginBtn) {
                        loginBtn.disabled = true;
                        loginBtn.style.opacity = '0.65';
                        loginBtn.style.cursor = 'not-allowed';
                        loginBtn.innerHTML = `<i class="bi bi-hourglass-split me-1"></i> Akses Diblokir (<span id="btnCountdownSec">${formatLockoutTime(secondsLeft)}</span>)`;
                    }

                    const countdownInterval = setInterval(function () {
                        secondsLeft--;
                        if (secondsLeft > 0) {
                            timerEl.textContent = secondsLeft;
                            if (formattedEl) {
                                formattedEl.textContent = formatLockoutTime(secondsLeft);
                            }
                            const btnSec = document.getElementById('btnCountdownSec');
                            if (btnSec) btnSec.textContent = formatLockoutTime(secondsLeft);
                        } else {
                            clearInterval(countdownInterval);
                            timerEl.textContent = '0';
                            if (formattedEl) formattedEl.textContent = '00:00';

                            const activeAlert = document.getElementById('lockoutAlertBox');
                            if (activeAlert) {
                                activeAlert.style.background = 'rgba(16, 185, 129, 0.12)';
                                activeAlert.style.borderLeft = '4px solid #10b981 !important';
                                activeAlert.innerHTML = `
                                    <div class="d-flex align-items-center gap-2 text-success">
                                        <i class="bi bi-check-circle-fill fs-4"></i>
                                        <div>
                                            <strong class="small fw-bold d-block">Waktu Tunggu Telah Selesai!</strong>
                                            <span class="small text-secondary">Akses login telah dibuka kembali. Anda sekarang dapat mencoba login kembali.</span>
                                        </div>
                                    </div>
                                `;
                            }

                            if (loginBtn) {
                                loginBtn.disabled = false;
                                loginBtn.style.opacity = '1';
                                loginBtn.style.cursor = 'pointer';
                                loginBtn.innerHTML = `Log In <i class="bi bi-box-arrow-in-right ms-1"></i>`;
                            }

                            const emailInp = document.getElementById('email');
                            if (emailInp) {
                                emailInp.classList.remove('is-invalid');
                            }
                        }
                    }, 1000);
                }
            }
        }

        initLockoutCountdown();
    </script>
</body>
</html>
