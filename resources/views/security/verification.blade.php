<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Keamanan — {{ $settings['company_name'] ?? 'Boutique Design Indonesia' }}</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Outfit:wght@300;400;500;600;700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-red: #c62828;
            --primary-red-hover: #b71c1c;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --success-green: #0f9d58;
            --recaptcha-blue: #4285F4;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 50%, #94a3b8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            color: var(--text-dark);
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient subtle backdrop elements */
        .ambient-circle-1 {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(198, 40, 40, 0.12) 0%, rgba(255, 255, 255, 0) 70%);
            top: -120px;
            left: -100px;
            pointer-events: none;
            filter: blur(50px);
        }

        .ambient-circle-2 {
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(66, 133, 244, 0.12) 0%, rgba(255, 255, 255, 0) 70%);
            bottom: -100px;
            right: -80px;
            pointer-events: none;
            filter: blur(50px);
        }

        .challenge-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12), 0 4px 12px rgba(0, 0, 0, 0.04);
            text-align: center;
            animation: fadeInCard 0.5s ease-out;
        }

        @keyframes fadeInCard {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo Branding */
        .brand-section {
            margin-bottom: 22px;
        }

        .logo-sig {
            font-family: 'Great Vibes', cursive;
            font-size: 3rem;
            color: var(--primary-red);
            line-height: 1;
            margin: 0;
            text-align: center;
            text-shadow: 0 2px 8px rgba(198, 40, 40, 0.1);
        }

        .logo-sub {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #334155;
            font-weight: 700;
            display: block;
            margin-top: -4px;
            text-align: center;
        }

        .brand-logo-img {
            max-height: 52px;
            max-width: 200px;
            object-fit: contain;
            margin-bottom: 6px;
        }

        .challenge-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
            letter-spacing: -0.2px;
        }

        .challenge-subtitle {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 26px;
            padding: 0 8px;
        }

        /* Authentic Google reCAPTCHA v2 Widget Container */
        .recaptcha-outer {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
        }

        .recaptcha-widget-card {
            width: 304px;
            height: 78px;
            background: #f9f9f9;
            border: 1px solid #d3d3d3;
            border-radius: 3px;
            box-shadow: 0 0 4px 1px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 12px;
            user-select: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            position: relative;
        }

        .recaptcha-widget-card:hover {
            border-color: #b2b2b2;
            box-shadow: 0 0 6px 1px rgba(0, 0, 0, 0.12);
        }

        .recaptcha-left {
            display: flex;
            align-items: center;
            cursor: pointer;
            flex-grow: 1;
        }

        .recaptcha-checkbox {
            width: 28px;
            height: 28px;
            border: 2px solid #c1c1c1;
            border-radius: 2px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            position: relative;
            flex-shrink: 0;
            transition: border-color 0.15s, background-color 0.15s;
            outline: none;
        }

        .recaptcha-checkbox:hover {
            border-color: #999999;
        }

        .recaptcha-checkbox:focus-visible {
            border-color: var(--recaptcha-blue);
            box-shadow: 0 0 0 2px rgba(66, 133, 244, 0.3);
        }

        /* Rotating Google reCAPTCHA Blue Spinner */
        .recaptcha-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(66, 133, 244, 0.25);
            border-top-color: var(--recaptcha-blue);
            border-radius: 50%;
            animation: spinRecaptcha 0.8s linear infinite;
        }

        @keyframes spinRecaptcha {
            to { transform: rotate(360deg); }
        }

        /* Authentic Green Checkmark */
        .recaptcha-checkmark {
            display: none;
            font-size: 24px;
            color: var(--success-green);
            line-height: 1;
            animation: checkBounce 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes checkBounce {
            0% { transform: scale(0); opacity: 0; }
            70% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        .recaptcha-checkbox.checked {
            border-color: #c1c1c1;
            background: #ffffff;
        }

        .recaptcha-checkbox.checked .recaptcha-checkmark {
            display: block;
        }

        .recaptcha-label {
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: #282727;
            cursor: pointer;
            white-space: nowrap;
        }

        .recaptcha-right {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-left: 10px;
            flex-shrink: 0;
        }

        .recaptcha-logo-svg {
            width: 32px;
            height: 32px;
            margin-bottom: 1px;
        }

        .recaptcha-brand-title {
            font-family: 'Roboto', Arial, sans-serif;
            font-size: 10px;
            font-weight: 700;
            color: #555555;
            letter-spacing: 0.2px;
            line-height: 1.1;
        }

        .recaptcha-links {
            font-family: 'Roboto', Arial, sans-serif;
            font-size: 8px;
            color: #555555;
            margin-top: 2px;
            white-space: nowrap;
        }

        .recaptcha-links a {
            color: #555555;
            text-decoration: none;
        }

        .recaptcha-links a:hover {
            text-decoration: underline;
        }

        /* Status & Alert Feedback */
        .status-box {
            display: none;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 0.85rem;
            margin-bottom: 16px;
            text-align: center;
            animation: fadeInAlert 0.3s ease;
        }

        @keyframes fadeInAlert {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .status-box.success {
            display: block;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .status-box.error {
            display: block;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        /* Footer Protection Badge */
        .protection-footer {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 0.78rem;
            color: #94a3b8;
        }

        .protection-footer i {
            color: var(--primary-red);
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

    <div class="ambient-circle-1"></div>
    <div class="ambient-circle-2"></div>

    <div class="challenge-container">
        <!-- Brand Section -->
        <div class="brand-section">
            @if(!empty($settings['site_logo']))
                <img src="{{ asset($settings['site_logo']) }}" alt="{{ $settings['company_name'] ?? 'Boutique Design' }}" class="brand-logo-img">
            @else
                <h1 class="logo-sig">Boutique</h1>
                <span class="logo-sub">{{ $settings['company_name'] ?? 'DESIGN INDONESIA' }}</span>
            @endif
        </div>

        <h2 class="challenge-title">Verifikasi Keamanan</h2>
        <p class="challenge-subtitle">
            Sebelum masuk ke halaman Company Profile, silakan selesaikan pemeriksaan di bawah ini.
        </p>

        <!-- Status Message Box -->
        <div id="statusBox" class="status-box"></div>

        <!-- Authentic Google reCAPTCHA v2 Box -->
        <div class="recaptcha-outer">
            <div class="recaptcha-widget-card" id="recaptchaCard">
                <div class="recaptcha-left" id="recaptchaClickArea" role="button" tabindex="0" aria-label="Saya bukan robot">
                    <div class="recaptcha-checkbox" id="recaptchaCheckbox">
                        <div class="recaptcha-spinner" id="recaptchaSpinner"></div>
                        <i class="bi bi-check-lg recaptcha-checkmark" id="recaptchaCheckmark"></i>
                    </div>
                    <span class="recaptcha-label" id="recaptchaLabel">Saya bukan robot</span>
                </div>
                <div class="recaptcha-right">
                    <svg class="recaptcha-logo-svg" viewBox="0 0 48 48">
                        <path fill="#4285F4" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 6c4.08 0 7.74 1.74 10.33 4.54L27.46 21.4A6.87 6.87 0 0 0 24 20c-3.87 0-7 3.13-7 7 0 1.25.33 2.42.9 3.44L11.02 36.32A13.93 13.93 0 0 1 10 24c0-7.73 6.27-14 14-14zm0 28c-4.08 0-7.74-1.74-10.33-4.54l6.87-6.86c.98.88 2.27 1.4 3.46 1.4 3.87 0 7-3.13 7-7 0-1.25-.33-2.42-.9-3.44l6.88-5.88A13.93 13.93 0 0 1 38 24c0 7.73-6.27 14-14 14z"/>
                    </svg>
                    <div class="recaptcha-brand-title">reCAPTCHA</div>
                    <div class="recaptcha-links">
                        <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privasi</a> - 
                        <a href="https://policies.google.com/terms" target="_blank" rel="noopener">Persyaratan</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden Data -->
        <input type="hidden" id="verificationToken" value="{{ $verificationToken }}">
        <input type="text" id="botTrap" style="position: absolute; left: -9999px; opacity: 0; pointer-events: none;" tabindex="-1" autocomplete="off">

        <div class="protection-footer">
            <i class="bi bi-shield-check"></i>
            <span>Dilindungi Sistem Keamanan Company Profile</span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const clickArea = document.getElementById('recaptchaClickArea');
            const checkbox = document.getElementById('recaptchaCheckbox');
            const spinner = document.getElementById('recaptchaSpinner');
            const checkmark = document.getElementById('recaptchaCheckmark');
            const label = document.getElementById('recaptchaLabel');
            const statusBox = document.getElementById('statusBox');
            const tokenInput = document.getElementById('verificationToken');
            const botTrapInput = document.getElementById('botTrap');

            let isVerifying = false;
            let isVerified = false;
            const startTime = Date.now();
            let mouseMoves = 0;

            function trackMovement() {
                mouseMoves++;
            }
            window.addEventListener('mousemove', trackMovement, { passive: true });
            window.addEventListener('touchmove', trackMovement, { passive: true });

            function showStatus(text, type) {
                statusBox.className = 'status-box ' + type;
                statusBox.innerHTML = (type === 'success' ? '<i class="bi bi-check-circle-fill me-1"></i> ' : '<i class="bi bi-exclamation-circle-fill me-1"></i> ') + text;
            }

            function performVerification() {
                if (isVerifying || isVerified) return;
                isVerifying = true;

                // Start authentic spinner
                spinner.style.display = 'block';
                checkmark.style.display = 'none';
                checkbox.style.borderColor = '#4285F4';
                label.textContent = 'Memverifikasi...';
                clickArea.style.pointerEvents = 'none';

                const elapsed = Date.now() - startTime;

                const payload = {
                    verification_token: tokenInput.value,
                    bot_trap: botTrapInput.value,
                    entropy: {
                        elapsed: elapsed,
                        moves: mouseMoves,
                        webdriver: (navigator.webdriver === true || !!window.__webdriver_evaluate || !!window.__selenium_evaluate),
                        screen: [window.screen.width, window.screen.height],
                        tz: Intl.DateTimeFormat().resolvedOptions().timeZone || 'Asia/Jakarta'
                    }
                };

                // Authentic Google reCAPTCHA feels natural with 650ms inspection time
                setTimeout(function () {
                    fetch("{{ route('security.verify') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            isVerified = true;
                            spinner.style.display = 'none';
                            checkbox.classList.add('checked');
                            checkmark.style.display = 'block';
                            checkbox.style.borderColor = '#c1c1c1';
                            label.textContent = 'Saya bukan robot';
                            showStatus('Verifikasi berhasil! Mengalihkan ke Company Profile...', 'success');

                            setTimeout(function () {
                                window.location.href = data.redirect || "{{ route('home') }}";
                            }, 500);
                        } else {
                            isVerifying = false;
                            spinner.style.display = 'none';
                            clickArea.style.pointerEvents = 'auto';
                            checkbox.style.borderColor = '#ef4444';
                            label.textContent = 'Saya bukan robot';
                            showStatus(data.message || 'Verifikasi tidak berhasil. Silakan coba kembali.', 'error');
                        }
                    })
                    .catch(function () {
                        isVerifying = false;
                        spinner.style.display = 'none';
                        clickArea.style.pointerEvents = 'auto';
                        checkbox.style.borderColor = '#ef4444';
                        label.textContent = 'Saya bukan robot';
                        showStatus('Gagal menghubungkan ke server verifikasi. Harap muat ulang halaman.', 'error');
                    });
                }, 650);
            }

            clickArea.addEventListener('click', performVerification);
            clickArea.addEventListener('keydown', function (e) {
                if (e.key === ' ' || e.key === 'Enter') {
                    e.preventDefault();
                    performVerification();
                }
            });
        });
    </script>
</body>
</html>
