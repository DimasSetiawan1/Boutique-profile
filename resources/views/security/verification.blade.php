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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --bg-primary: #0a0c10;
            --bg-card: rgba(20, 24, 33, 0.85);
            --border-card: rgba(255, 255, 255, 0.1);
            --accent-red: #c62828;
            --accent-glow: rgba(198, 40, 40, 0.35);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --success-color: #10b981;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient Glow Background */
        .ambient-glow-1 {
            position: absolute;
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(198, 40, 40, 0.22) 0%, rgba(10, 12, 16, 0) 70%);
            top: -120px;
            left: -120px;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(60px);
            z-index: 0;
            animation: pulseGlow 8s ease-in-out infinite alternate;
        }

        .ambient-glow-2 {
            position: absolute;
            width: 480px;
            height: 480px;
            background: radial-gradient(circle, rgba(30, 58, 138, 0.2) 0%, rgba(10, 12, 16, 0) 70%);
            bottom: -90px;
            right: -90px;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(60px);
            z-index: 0;
            animation: pulseGlow 10s ease-in-out infinite alternate-reverse;
        }

        @keyframes pulseGlow {
            0% { transform: scale(1); opacity: 0.7; }
            100% { transform: scale(1.15); opacity: 1; }
        }

        .verification-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 490px;
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-radius: 24px;
            padding: 42px 34px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.65), 0 0 40px rgba(198, 40, 40, 0.12);
            text-align: center;
            transition: all 0.3s ease;
        }

        .brand-header {
            margin-bottom: 24px;
        }

        .brand-logo-img {
            max-height: 55px;
            max-width: 190px;
            object-fit: contain;
            margin-bottom: 16px;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.5));
        }

        .shield-icon-wrapper {
            width: 70px;
            height: 70px;
            background: rgba(198, 40, 40, 0.12);
            border: 1px solid rgba(198, 40, 40, 0.35);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            color: #ef4444;
            margin-bottom: 18px;
            box-shadow: 0 0 25px var(--accent-glow);
            animation: shieldPulse 3s infinite ease-in-out;
        }

        @keyframes shieldPulse {
            0%, 100% { transform: scale(1); box-shadow: 0 0 20px rgba(198, 40, 40, 0.25); }
            50% { transform: scale(1.05); box-shadow: 0 0 35px rgba(198, 40, 40, 0.45); }
        }

        .brand-name {
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .verification-title {
            font-size: 1.45rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .verification-desc {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.55;
            margin-bottom: 28px;
        }

        /* Turnstile / Cloudflare Style Bot Checkbox Widget */
        .turnstile-box {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            cursor: pointer;
            user-select: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            text-align: left;
        }

        .turnstile-box:hover {
            border-color: #9ca3af;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            transform: translateY(-1px);
        }

        .turnstile-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .custom-checkbox {
            width: 32px;
            height: 32px;
            border: 2px solid #9ca3af;
            border-radius: 6px;
            background: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            position: relative;
            flex-shrink: 0;
        }

        .turnstile-box:hover .custom-checkbox {
            border-color: var(--accent-red);
        }

        /* Spinner in checkbox */
        .spinner {
            width: 20px;
            height: 20px;
            border: 2.5px solid rgba(198, 40, 40, 0.25);
            border-top-color: var(--accent-red);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Checkmark */
        .check-icon {
            display: none;
            font-size: 24px;
            color: var(--success-color);
            animation: scaleIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        .turnstile-label {
            font-size: 1.05rem;
            font-weight: 600;
            color: #1f2937;
            display: flex;
            flex-direction: column;
        }

        .turnstile-sublabel {
            font-size: 0.75rem;
            color: #6b7280;
            font-weight: 400;
            margin-top: 1px;
        }

        .turnstile-right {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-left: 14px;
            border-left: 1px solid #e5e7eb;
        }

        .turnstile-brand-icon {
            font-size: 26px;
            color: #4b5563;
        }

        .turnstile-brand-text {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #6b7280;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .turnstile-privacy-text {
            font-size: 0.58rem;
            color: #9ca3af;
        }

        /* Status Alert */
        .status-message {
            font-size: 0.9rem;
            padding: 12px 16px;
            border-radius: 12px;
            margin-top: 18px;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .status-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399;
        }

        .status-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="verification-container">
        <!-- Brand Header -->
        <div class="brand-header">
            @if(!empty($settings['site_logo']))
                <img src="{{ asset($settings['site_logo']) }}" alt="{{ $settings['company_name'] ?? 'Boutique Design' }}" class="brand-logo-img">
            @else
                <div class="shield-icon-wrapper">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="brand-name">{{ $settings['company_name'] ?? 'BOUTIQUE DESIGN INDONESIA' }}</div>
            @endif
        </div>

        <h1 class="verification-title">Pemeriksaan Keamanan Peramban</h1>
        <p class="verification-desc">
            Verifikasi di bawah ini untuk memastikan Anda adalah manusia sebelum mengakses situs Profile Boutique Design Indonesia.
        </p>

        <!-- Interactive Turnstile Checkbox Widget -->
        <div class="turnstile-box" id="turnstileBox" role="button" tabindex="0" aria-label="Saya bukan robot">
            <div class="turnstile-left">
                <div class="custom-checkbox" id="checkboxSquare">
                    <div class="spinner" id="spinnerIcon"></div>
                    <i class="bi bi-check-lg check-icon" id="checkIcon"></i>
                </div>
                <div class="turnstile-label">
                    <span id="labelMain">Saya bukan robot</span>
                    <span class="turnstile-sublabel" id="labelSub">Verifikasi keamanan sekali klik</span>
                </div>
            </div>
            <div class="turnstile-right">
                <i class="bi bi-shield-lock-fill turnstile-brand-icon" id="shieldBrandIcon"></i>
                <span class="turnstile-brand-text">CyberShield</span>
                <span class="turnstile-privacy-text">Privasi & Keamanan</span>
            </div>
        </div>

        <!-- Status Message Banner -->
        <div id="statusMessage" class="status-message"></div>

        <!-- Hidden inputs for verification payload -->
        <input type="hidden" id="verificationToken" value="{{ $verificationToken }}">
        <input type="text" id="botTrap" style="display:none !important;" tabindex="-1" autocomplete="off">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const turnstileBox = document.getElementById('turnstileBox');
            const checkboxSquare = document.getElementById('checkboxSquare');
            const spinnerIcon = document.getElementById('spinnerIcon');
            const checkIcon = document.getElementById('checkIcon');
            const labelMain = document.getElementById('labelMain');
            const labelSub = document.getElementById('labelSub');
            const statusMessage = document.getElementById('statusMessage');
            const verificationToken = document.getElementById('verificationToken').value;
            const botTrap = document.getElementById('botTrap');

            let isVerifying = false;
            let isDone = false;
            const pageLoadedAt = Date.now();

            // Real biometric & human interaction tracking
            let mouseMoveCount = 0;
            let lastMouseX = 0, lastMouseY = 0;
            
            function onHumanMove(e) {
                mouseMoveCount++;
                lastMouseX = e.clientX || 0;
                lastMouseY = e.clientY || 0;
            }
            window.addEventListener('mousemove', onHumanMove, { passive: true });
            window.addEventListener('touchmove', onHumanMove, { passive: true });

            function showStatus(msg, isSuccess) {
                statusMessage.className = 'status-message ' + (isSuccess ? 'status-success' : 'status-error');
                statusMessage.innerHTML = (isSuccess ? '<i class="bi bi-check-circle-fill me-2"></i>' : '<i class="bi bi-exclamation-triangle-fill me-2"></i>') + msg;
                statusMessage.style.display = 'block';
            }

            function triggerVerification() {
                if (isVerifying || isDone) return;
                isVerifying = true;

                // UI Loading state
                checkboxSquare.style.borderColor = 'var(--accent-red)';
                spinnerIcon.style.display = 'block';
                labelMain.textContent = 'Memverifikasi...';
                labelSub.textContent = 'Harap tunggu sesaat';
                turnstileBox.style.pointerEvents = 'none';

                const clientElapsed = Date.now() - pageLoadedAt;

                // Kumpulkan data entropy browser asli
                const clientEntropy = {
                    elapsed: clientElapsed,
                    moves: mouseMoveCount,
                    webdriver: navigator.webdriver === true || !!window.__webdriver_evaluate || !!window.__selenium_evaluate,
                    screen: [window.screen.width, window.screen.height, window.devicePixelRatio || 1],
                    pluginsLength: (navigator.plugins ? navigator.plugins.length : 0),
                    hasTouch: ('ontouchstart' in window) || (navigator.maxTouchPoints > 0)
                };

                // Realistis delay 700ms untuk perhitungan keamanan
                setTimeout(() => {
                    fetch("{{ route('security.verify') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({
                            verification_token: verificationToken,
                            entropy: clientEntropy,
                            bot_trap: botTrap.value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            isDone = true;
                            // State Sukses
                            spinnerIcon.style.display = 'none';
                            checkIcon.style.display = 'block';
                            checkboxSquare.style.borderColor = 'var(--success-color)';
                            checkboxSquare.style.background = 'rgba(16, 185, 129, 0.15)';

                            labelMain.innerHTML = '<span style="color: #059669; font-weight:700;">Terverifikasi!</span>';
                            labelSub.textContent = 'Mengalihkan ke halaman company profile...';

                            showStatus('Verifikasi berhasil! Mengalihkan Anda ke website...', true);

                            // Redirect mulus ke website
                            setTimeout(() => {
                                window.location.href = data.redirect || "{{ route('home') }}";
                            }, 650);
                        } else {
                            isVerifying = false;
                            spinnerIcon.style.display = 'none';
                            turnstileBox.style.pointerEvents = 'auto';
                            labelMain.textContent = 'Saya bukan robot';
                            labelSub.textContent = 'Verifikasi ulang';
                            showStatus(data.message || 'Verifikasi gagal. Harap coba lagi.', false);
                        }
                    })
                    .catch(err => {
                        isVerifying = false;
                        spinnerIcon.style.display = 'none';
                        turnstileBox.style.pointerEvents = 'auto';
                        labelMain.textContent = 'Saya bukan robot';
                        labelSub.textContent = 'Klik untuk mencoba kembali';
                        showStatus('Terjadi kesalahan koneksi. Harap muat ulang halaman.', false);
                    });
                }, 700);
            }

            // Bind click & keyboard trigger
            turnstileBox.addEventListener('click', triggerVerification);
            turnstileBox.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    triggerVerification();
                }
            });
        });
    </script>
</body>
</html>
