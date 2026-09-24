<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP & Keamanan - Boutique Design</title>
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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            width: 100%;
            max-width: 450px;
            padding: 38px 34px;
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
            margin-bottom: 22px;
        }

        .otp-icon-circle {
            width: 68px;
            height: 68px;
            background: rgba(198, 40, 40, 0.1);
            color: #c62828;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.9rem;
            margin: 0 auto 16px auto;
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
            transition: all 0.2s ease;
        }

        .otp-input:focus {
            border-color: #c62828;
            box-shadow: 0 0 0 4px rgba(198, 40, 40, 0.15);
        }

        /* Authentic Google reCAPTCHA v2 Widget */
        .recaptcha-card {
            background: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.25s ease;
            user-select: none;
            padding: 12px 16px;
        }

        .recaptcha-card:hover {
            border-color: #9ca3af;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .recaptcha-checkbox-box {
            width: 28px;
            height: 28px;
            border: 2px solid #9ca3af;
            border-radius: 5px;
            background: #ffffff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            position: relative;
            flex-shrink: 0;
        }

        .recaptcha-checkbox-box:hover {
            border-color: #3b82f6;
        }

        .recaptcha-spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2.5px solid #3b82f6;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spinRecaptcha 0.65s linear infinite;
        }

        .recaptcha-checkmark {
            display: none;
            color: #16a34a;
            font-size: 1.45rem;
            font-weight: 800;
            line-height: 1;
        }

        .recaptcha-checkbox-box.checked {
            border-color: #16a34a;
            background: #f0fdf4;
        }

        .recaptcha-checkbox-box.checked .recaptcha-checkmark {
            display: block;
        }

        .recaptcha-label {
            font-size: 0.92rem;
            font-weight: 500;
            color: #1f2937;
            cursor: pointer;
            margin: 0;
        }

        .recaptcha-logo-img {
            width: 24px;
            height: 24px;
            margin-bottom: 2px;
        }

        .recaptcha-brand-text {
            font-size: 0.65rem;
            color: #6b7280;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .recaptcha-policy-links {
            font-size: 0.55rem;
            color: #9ca3af;
        }

        .recaptcha-policy-links a {
            color: #9ca3af;
            text-decoration: none;
        }

        .recaptcha-policy-links a:hover {
            text-decoration: underline;
        }

        @keyframes spinRecaptcha {
            to { transform: rotate(360deg); }
        }

        .btn-verify {
            background: #c62828;
            color: #fff;
            padding: 13px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(198, 40, 40, 0.15);
            font-size: 0.98rem;
        }

        .btn-verify:hover:not(:disabled) {
            background: #b71c1c;
            transform: translateY(-1px);
        }

        .btn-verify:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            opacity: 0.75;
            box-shadow: none;
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

        .lockout-alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 20px;
            color: #b91c1c;
            text-align: left;
            font-size: 0.88rem;
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

        <h4 class="fw-bold mb-2" style="color:#1e293b;">Verifikasi Kode OTP & Keamanan</h4>
        <p class="text-secondary small mb-3">
            Masukkan 6 digit kode OTP yang telah dikirim ke email:<br>
            <strong class="text-dark">{{ session('reset_email') ?? 'email Anda' }}</strong>
        </p>

        @if($isLocked ?? false)
            @php
                $currentTier = $lockoutTier ?? (session('lockout_tier') ?? 1);
                $isWrongOtp = (session('lockout_reason') === '3x_wrong_otp');

                if ($isWrongOtp) {
                    if ((int)$currentTier === 2) {
                        $tierInfo = [
                            'title' => 'Verifikasi OTP Diblokir - Tingkat 2',
                            'desc' => 'Terdeteksi 3x salah memasukkan kode OTP kembali. Akses input OTP diblokir selama 5 menit.',
                            'badge' => 'Tingkat 2 (Blokir 5 Menit)'
                        ];
                    } elseif ((int)$currentTier === 3) {
                        $tierInfo = [
                            'title' => 'Verifikasi OTP Diblokir Maksimal - Tingkat 3',
                            'desc' => 'Terdeteksi kesalahan memasukkan kode OTP berulang kali. Akses input OTP diblokir selama 1 jam.',
                            'badge' => 'Tingkat 3 (Blokir 1 Jam)'
                        ];
                    } else {
                        $tierInfo = [
                            'title' => 'Verifikasi OTP Diblokir - Tingkat 1',
                            'desc' => 'Terdeteksi 3x salah memasukkan kode OTP. Akses input OTP diblokir selama 1 menit.',
                            'badge' => 'Tingkat 1 (Blokir 1 Menit)'
                        ];
                    }
                } else {
                    if ((int)$currentTier === 2) {
                        $tierInfo = [
                            'title' => 'Akun Diblokir Sementara - Tingkat 2',
                            'desc' => 'Percobaan login kembali tanpa verifikasi OTP terdeteksi (3x salah). Akses diblokir selama 5 menit.',
                            'badge' => 'Tingkat 2 (Blokir 5 Menit)'
                        ];
                    } elseif ((int)$currentTier === 3) {
                        $tierInfo = [
                            'title' => 'Akun Diblokir Maksimal - Tingkat 3',
                            'desc' => 'Percobaan login berulang tanpa verifikasi OTP terdeteksi. Akses akun diblokir selama 1 jam.',
                            'badge' => 'Tingkat 3 (Blokir 1 Jam)'
                        ];
                    } else {
                        $tierInfo = [
                            'title' => 'Akun Diblokir Sementara - Tingkat 1',
                            'desc' => 'Terdeteksi 3x salah memasukkan kata sandi. Akses akun diblokir selama 1 menit.',
                            'badge' => 'Tingkat 1 (Blokir 1 Menit)'
                        ];
                    }
                }
            @endphp
            <div class="lockout-alert" id="lockoutBox">
                <div class="d-flex align-items-center justify-content-between mb-1.5 flex-wrap gap-1">
                    <div class="d-flex align-items-center fw-bold text-danger">
                        <i class="bi bi-shield-exclamation me-2 fs-5"></i>
                        <span>{{ $tierInfo['title'] }}</span>
                    </div>
                    <span class="badge bg-danger text-white px-2.5 py-1 rounded-pill small fw-semibold shadow-xs">
                        {{ $tierInfo['badge'] }}
                    </span>
                </div>
                <div class="small text-secondary mb-2" style="line-height: 1.45;">
                    {{ $tierInfo['desc'] }}
                </div>
                <div class="d-flex align-items-center gap-2 mb-2 p-2 bg-white rounded-3 border shadow-xs">
                    <i class="bi bi-clock-history text-danger fs-5"></i>
                    <span class="fs-5 fw-bold text-danger font-monospace" id="countdownFormatted">00:00</span>
                    <span class="small text-secondary">(<strong id="countdownText" class="text-danger">{{ $lockoutRemaining ?? 60 }}</strong> detik tersisa)</span>
                </div>
                <div class="p-2.5 rounded-3 text-start" style="background: rgba(239, 68, 68, 0.08); border-left: 3px solid #dc2626; font-size: 0.84rem; color: #991b1b; line-height: 1.45;">
                    <i class="bi bi-info-circle-fill me-1"></i> <strong>Pemberitahuan:</strong> Kode OTP baru dari Gmail <u>belum dikirimkan</u>. Anda harus menunggu hingga waktu hitungan mundur blokir selesai. Begitu waktu blokir selesai, kode OTP baru akan <strong>langsung otomatis dikirim ke Gmail Anda</strong> dan kolom input di bawah ini akan aktif.
                </div>
            </div>
        @elseif(!empty($otpSent))
            <div class="alert alert-success border-0 rounded-4 p-3 mb-3 text-start shadow-sm" style="background: rgba(16, 185, 129, 0.12); color: #065f46;" id="lockoutBox">
                <div class="d-flex align-items-center fw-bold mb-1">
                    <i class="bi bi-check-circle-fill me-2 fs-5 text-success"></i>
                    <span>Kode OTP Telah Dikirim ke Gmail</span>
                </div>
                <div class="small text-secondary" style="line-height: 1.5;">
                    Kode OTP 6-digit telah dikirimkan ke Gmail: <strong>{{ session('reset_email') ?? 'email Anda' }}</strong>. Silakan periksa inbox/spam Gmail Anda dan masukkan 6 digit kodenya di bawah ini.
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 rounded-3 p-3 mb-3 text-start" style="font-size: 0.88rem; background: rgba(244, 67, 54, 0.12); color: #c62828;">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 p-3 mb-3 text-start" style="font-size: 0.88rem; background: rgba(76, 175, 80, 0.12); color: #2e7d32;">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning border-0 rounded-3 p-3 mb-3 text-start" style="font-size: 0.88rem; background: rgba(255, 152, 0, 0.15); color: #b45309;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('warning') }}
            </div>
        @endif

        <form action="{{ route('admin.password.otp.verify') }}" method="POST" id="otpForm">
            @csrf
            
            <!-- OTP Input -->
            <div class="mb-3 text-start">
                <label for="otp" class="form-label small fw-bold text-secondary text-uppercase" style="letter-spacing: 1px;">6-Digit Kode OTP</label>
                <input type="text" 
                       class="form-control otp-input @error('otp') is-invalid @enderror" 
                       id="otp" 
                       name="otp" 
                       maxlength="6" 
                       required 
                       {{ ($isLocked ?? false) ? 'disabled' : 'autofocus' }} 
                       placeholder="{{ ($isLocked ?? false) ? 'Menunggu waktu blokir...' : '••••••' }}"
                       inputmode="numeric"
                       autocomplete="one-time-code">
                <div id="otpLockedNote" class="small text-muted mt-1 text-center" style="{{ ($isLocked ?? false) ? '' : 'display: none;' }}">
                    <i class="bi bi-lock-fill me-1 text-danger"></i> <span class="text-danger fw-medium">Kolom input OTP terkunci selama masa blokir berlangsung.</span>
                </div>
                @error('otp')
                    <div class="invalid-feedback text-center mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Authentic Google reCAPTCHA v2 Widget -->
            <div class="mb-3 text-start">
                <div class="recaptcha-card" id="recaptchaCard" style="{{ ($isLocked ?? false) ? 'pointer-events: none; opacity: 0.6; cursor: not-allowed;' : '' }}">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="recaptcha-checkbox-box" id="recaptchaTrigger" role="checkbox" aria-checked="false" tabindex="0">
                                <div class="recaptcha-spinner" id="recaptchaSpinner"></div>
                                <i class="bi bi-check-lg recaptcha-checkmark" id="recaptchaCheckmark"></i>
                            </div>
                            <label class="recaptcha-label" id="recaptchaLabel">Saya bukan robot</label>
                        </div>
                        <div class="text-center d-flex flex-column align-items-center ps-2">
                            <svg class="recaptcha-logo-img" viewBox="0 0 48 48">
                                <path fill="#4285F4" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 6c4.08 0 7.74 1.74 10.33 4.54L27.46 21.4A6.87 6.87 0 0 0 24 20c-3.87 0-7 3.13-7 7 0 1.25.33 2.42.9 3.44L11.02 36.32A13.93 13.93 0 0 1 10 24c0-7.73 6.27-14 14-14zm0 28c-4.08 0-7.74-1.74-10.33-4.54l6.87-6.86c.98.88 2.27 1.4 3.46 1.4 3.87 0 7-3.13 7-7 0-1.25-.33-2.42-.9-3.44l6.88-5.88A13.93 13.93 0 0 1 38 24c0 7.73-6.27 14-14 14z"/>
                            </svg>
                            <span class="recaptcha-brand-text">reCAPTCHA</span>
                            <span class="recaptcha-policy-links">
                                <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privasi</a> - 
                                <a href="https://policies.google.com/terms" target="_blank" rel="noopener">Persyaratan</a>
                            </span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="recaptcha_token" id="recaptchaToken" value="">
                @error('recaptcha')
                    <div class="text-danger small mt-2 d-flex align-items-center">
                        <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-verify mb-3" id="btnSubmit" disabled>
                Verifikasi & Lanjut Ganti Password <i class="bi bi-arrow-right-circle ms-1"></i>
            </button>
        </form>

        <div class="my-3 text-secondary small" id="resendSection">
            @if($isLocked ?? false)
                <span class="text-muted"><i class="bi bi-clock-history me-1"></i> Kirim ulang kode OTP dapat dilakukan setelah waktu blokir berakhir.</span>
            @else
                Belum menerima kode? 
                <form action="{{ route('admin.password.otp.resend') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="resend-btn">Kirim Ulang</button>
                </form>
            @endif
        </div>

        <div class="mt-4 pt-3 border-top">
            <a href="{{ route('admin.login') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Kembali ke Halaman Login
            </a>
        </div>
    </div>

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

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const otpInput = document.getElementById('otp');
        const recaptchaCard = document.getElementById('recaptchaCard');
        const recaptchaTrigger = document.getElementById('recaptchaTrigger');
        const recaptchaLabel = document.getElementById('recaptchaLabel');
        const recaptchaSpinner = document.getElementById('recaptchaSpinner');
        const recaptchaCheckmark = document.getElementById('recaptchaCheckmark');
        const recaptchaToken = document.getElementById('recaptchaToken');
        const btnSubmit = document.getElementById('btnSubmit');
        const otpLockedNote = document.getElementById('otpLockedNote');
        const resendSection = document.getElementById('resendSection');

        let isRecaptchaPassed = false;
        let isLockedState = {{ ($isLocked ?? false) ? 'true' : 'false' }};
        const challengePayload = "{{ $recaptchaChallenge ?? '' }}";
        const sendLockoutOtpUrl = "{{ route('admin.password.lockout.send_otp') }}";
        const csrfTokenVal = "{{ csrf_token() }}";
        const resendOtpUrl = "{{ route('admin.password.otp.resend') }}";

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
            if (msgEl) msgEl.textContent = message;
            if (btnEl) btnEl.textContent = btnText;

            if (iconBox && iconEl) {
                if (type === 'success') {
                    iconBox.style.background = 'rgba(16, 185, 129, 0.12)';
                    iconBox.style.borderColor = 'rgba(16, 185, 129, 0.25)';
                    iconEl.className = 'bi bi-check-circle-fill text-success';
                } else if (type === 'error' || type === 'danger') {
                    iconBox.style.background = 'rgba(239, 68, 68, 0.12)';
                    iconBox.style.borderColor = 'rgba(239, 68, 68, 0.25)';
                    iconEl.className = 'bi bi-x-circle-fill text-danger';
                } else {
                    iconBox.style.background = 'rgba(245, 158, 11, 0.12)';
                    iconBox.style.borderColor = 'rgba(245, 158, 11, 0.25)';
                    iconEl.className = 'bi bi-exclamation-triangle-fill text-warning';
                }
            }

            const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.show();
        };

        function updateSubmitButton() {
            if (!isLockedState && otpInput.value.length === 6 && isRecaptchaPassed) {
                btnSubmit.disabled = false;
            } else {
                btnSubmit.disabled = true;
            }
        }

        // OTP Input Digits Only
        if (otpInput) {
            otpInput.addEventListener('input', function(e) {
                if (isLockedState) return;
                this.value = this.value.replace(/\D/g, '').slice(0, 6);
                updateSubmitButton();
            });
            otpInput.addEventListener('paste', function(e) {
                if (isLockedState) return;
                e.preventDefault();
                const pasteData = (e.clipboardData || window.clipboardData).getData('text');
                this.value = pasteData.replace(/\D/g, '').slice(0, 6);
                updateSubmitButton();
            });
        }

        // reCAPTCHA Interaction
        function triggerRecaptcha() {
            if (isLockedState || isRecaptchaPassed) return;

            recaptchaSpinner.style.display = 'block';
            recaptchaTrigger.style.pointerEvents = 'none';

            setTimeout(() => {
                recaptchaSpinner.style.display = 'none';
                recaptchaTrigger.classList.add('checked');
                recaptchaTrigger.setAttribute('aria-checked', 'true');
                recaptchaToken.value = challengePayload;
                isRecaptchaPassed = true;
                updateSubmitButton();
            }, 450);
        }

        if (recaptchaTrigger) {
            recaptchaTrigger.addEventListener('click', triggerRecaptcha);
            recaptchaTrigger.addEventListener('keydown', function(e) {
                if (e.key === ' ' || e.key === 'Enter') {
                    e.preventDefault();
                    triggerRecaptcha();
                }
            });
        }
        if (recaptchaLabel) {
            recaptchaLabel.addEventListener('click', triggerRecaptcha);
        }

        // Countdown Timer for Lockout & Automatic OTP Dispatch
        const countdownEl = document.getElementById('countdownText');
        let otpRequestSent = false;

        function triggerLockoutOtpSend() {
            if (otpRequestSent) return;
            otpRequestSent = true;

            const lockoutBox = document.getElementById('lockoutBox');
            if (lockoutBox) {
                lockoutBox.className = 'alert border-0 rounded-4 p-3 mb-3 text-start shadow-sm';
                lockoutBox.style.background = 'rgba(59, 130, 246, 0.1)';
                lockoutBox.style.color = '#1e40af';
                lockoutBox.innerHTML = `
                    <div class="d-flex align-items-center gap-2">
                        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                        <div>
                            <strong class="d-block text-primary">Waktu blokir telah selesai!</strong>
                            <span class="small text-secondary">Sedang membuat dan mengirimkan kode OTP ke Gmail Anda...</span>
                        </div>
                    </div>
                `;
            }

            // AJAX call to server to generate and send OTP to Gmail
            fetch(sendLockoutOtpUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfTokenVal,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                isLockedState = false;

                if (lockoutBox) {
                    lockoutBox.style.background = 'rgba(16, 185, 129, 0.12)';
                    lockoutBox.style.color = '#065f46';
                    lockoutBox.innerHTML = `
                        <div class="d-flex align-items-center fw-bold text-success mb-1">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <span>Waktu Blokir Selesai & Kode OTP Berhasil Dikirim!</span>
                        </div>
                        <div class="small text-secondary" style="line-height: 1.5;">
                            Kode OTP 6-digit telah langsung dikirimkan ke Gmail Anda (<strong>${data.email || '{{ session('reset_email') }}'}</strong>). Silakan periksa Gmail Anda dan masukkan 6 digit kode OTP pada kolom di bawah.
                        </div>
                    `;
                }

                // Unlock OTP Input
                if (otpInput) {
                    otpInput.disabled = false;
                    otpInput.placeholder = '••••••';
                    otpInput.focus();
                }

                if (otpLockedNote) {
                    otpLockedNote.style.display = 'none';
                }

                // Unlock reCAPTCHA widget
                if (recaptchaCard) {
                    recaptchaCard.style.pointerEvents = 'auto';
                    recaptchaCard.style.opacity = '1';
                    recaptchaCard.style.cursor = 'default';
                }

                // Enable Resend Button
                if (resendSection) {
                    resendSection.innerHTML = `
                        Belum menerima kode? 
                        <form action="${resendOtpUrl}" method="POST" class="d-inline">
                            <input type="hidden" name="_token" value="${csrfTokenVal}">
                            <button type="submit" class="resend-btn">Kirim Ulang</button>
                        </form>
                    `;
                }

                // Show Pop Up Oke
                window.systemAlert(
                    'Waktu blokir telah selesai! Kode OTP 6-digit telah langsung dikirimkan ke Gmail Anda. Silakan masukkan kode OTP untuk melanjutkan reset kata sandi.',
                    'Kode OTP Terkirim ke Gmail',
                    'success',
                    'Oke'
                );
            })
            .catch(err => {
                console.error('Error sending lockout OTP:', err);
                // Fallback unlock if network glitch
                isLockedState = false;
                if (otpInput) {
                    otpInput.disabled = false;
                    otpInput.placeholder = '••••••';
                }
                if (recaptchaCard) {
                    recaptchaCard.style.pointerEvents = 'auto';
                    recaptchaCard.style.opacity = '1';
                }
            });
        }

        function formatCountdownTime(totalSec) {
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

        const countdownFormattedEl = document.getElementById('countdownFormatted');

        if (countdownEl) {
            let secondsLeft = parseInt(countdownEl.textContent, 10) || 60;
            if (countdownFormattedEl) {
                countdownFormattedEl.textContent = formatCountdownTime(secondsLeft);
            }

            const timerInterval = setInterval(() => {
                secondsLeft--;
                if (secondsLeft > 0) {
                    countdownEl.textContent = secondsLeft;
                    if (countdownFormattedEl) {
                        countdownFormattedEl.textContent = formatCountdownTime(secondsLeft);
                    }
                } else {
                    clearInterval(timerInterval);
                    countdownEl.textContent = '0';
                    if (countdownFormattedEl) countdownFormattedEl.textContent = '00:00';
                    triggerLockoutOtpSend();
                }
            }, 1000);
        }
    </script>
</body>
</html>
