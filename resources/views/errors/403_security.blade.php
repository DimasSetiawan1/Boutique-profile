<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Akses Ditolak - Security Shield Active' }} | Boutique Design Indonesia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-dark: #0a0e17;
            --card-bg: rgba(17, 24, 39, 0.95);
            --danger-red: #ef4444;
            --danger-glow: rgba(239, 68, 68, 0.25);
            --gold-accent: #d4af37;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: rgba(239, 68, 68, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 50% 20%, #1e1124 0%, var(--bg-dark) 70%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Subtle animated grid background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .security-container {
            max-width: 580px;
            width: 100%;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.8), 0 0 40px var(--danger-glow);
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            z-index: 10;
            backdrop-filter: blur(16px);
        }

        .shield-icon-wrapper {
            width: 86px;
            height: 86px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(220, 38, 38, 0.05));
            border: 2px solid rgba(239, 68, 68, 0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 30px var(--danger-glow);
            animation: pulse-glow 2.5s infinite alternate;
        }

        .shield-icon-wrapper i {
            font-size: 2.5rem;
            color: var(--danger-red);
        }

        @keyframes pulse-glow {
            0% {
                box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);
                transform: scale(1);
            }
            100% {
                box-shadow: 0 0 35px rgba(239, 68, 68, 0.4);
                transform: scale(1.04);
            }
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.35rem 0.9rem;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 9999px;
            font-size: 0.78rem;
            font-weight: 700;
            color: #fca5a5;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 1.25rem;
        }

        .badge-status span {
            display: inline-block;
            width: 7px;
            height: 7px;
            background-color: var(--danger-red);
            border-radius: 50%;
        }

        h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }

        p.description {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.75rem;
        }

        .details-box {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.75rem;
            text-align: left;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
        }

        .details-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.4rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .details-row:last-child {
            border-bottom: none;
        }

        .details-label {
            color: #64748b;
        }

        .details-val {
            color: #e2e8f0;
            font-weight: 600;
        }

        .threat-tag {
            color: #f87171;
            font-weight: 700;
            background: rgba(239, 68, 68, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.4rem;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-home:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-2px);
        }

        .footer-note {
            margin-top: 1.75rem;
            font-size: 0.75rem;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
    </style>
</head>
<body>

    <div class="security-container">
        <div class="shield-icon-wrapper">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <div class="badge-status">
            <span></span> HTTP 403 Forbidden &bull; Anti SQL Injection Guard
        </div>

        <h1>{{ $title ?? 'Akses Ditolak Demi Keamanan' }}</h1>

        <p class="description">
            {{ $message ?? 'Sistem mendeteksi upaya injeksi SQL atau muatan parameter berbahaya. Seluruh permintaan yang mencurigakan diblokir otomatis untuk menjaga integritas data.' }}
        </p>

        <div class="details-box">
            <div class="details-row">
                <span class="details-label">WAF Guard:</span>
                <span class="details-val">Anti-SQLi WAF Active</span>
            </div>
            <div class="details-row">
                <span class="details-label">Kategori Deteksi:</span>
                <span class="details-val threat-tag">{{ $threat ?? 'SQL_INJECTION' }}</span>
            </div>
            <div class="details-row">
                <span class="details-label">IP Address Anda:</span>
                <span class="details-val">{{ request()->ip() ?? '127.0.0.1' }}</span>
            </div>
            <div class="details-row">
                <span class="details-label">Waktu Deteksi:</span>
                <span class="details-val">{{ date('Y-m-d H:i:s T') }}</span>
            </div>
        </div>

        <div class="action-buttons">
            <a href="javascript:history.back()" class="btn-home" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Sebelumnya
            </a>
            <a href="{{ route('home') }}" class="btn-home">
                <i class="fa-solid fa-house"></i> Beranda Utama
            </a>
        </div>

        <div class="footer-note">
            <i class="fa-solid fa-lock"></i> Dilindungi oleh Sistem Keamanan Terpadu Boutique Design Indonesia
        </div>
    </div>

</body>
</html>
