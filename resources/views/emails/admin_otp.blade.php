<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi Login</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 40px 20px;
            color: #334155;
        }
        .email-container {
            max-width: 520px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        .email-header {
            background: #c62828;
            padding: 30px 20px;
            text-align: center;
            color: #ffffff;
        }
        .header-title {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 1px;
            margin: 0;
        }
        .header-subtitle {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 3px;
            opacity: 0.9;
            margin-top: 4px;
        }
        .email-body {
            padding: 36px 30px;
            text-align: center;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
        }
        .desc {
            font-size: 15px;
            line-height: 1.6;
            color: #64748b;
            margin-bottom: 28px;
        }
        .otp-box {
            display: inline-block;
            background: #f8fafc;
            border: 2px dashed #c62828;
            border-radius: 12px;
            padding: 16px 36px;
            font-size: 36px;
            font-weight: 800;
            letter-spacing: 10px;
            color: #c62828;
            margin-bottom: 24px;
        }
        .notice {
            font-size: 13px;
            color: #94a3b8;
            line-height: 1.5;
        }
        .email-footer {
            background: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1 class="header-title">Boutique Design</h1>
            <div class="header-subtitle">Security Authentication</div>
        </div>
        <div class="email-body">
            <div class="greeting">Halo, {{ $userName }}!</div>
            <p class="desc">
                Anda menerima email ini untuk keperluan <strong>{{ $purpose ?? 'keamanan akun' }}</strong> di Panel Admin Boutique Design. Silakan gunakan kode verifikasi sekali pakai (OTP) di bawah ini:
            </p>
            
            <div class="otp-box" style="user-select: all; -webkit-user-select: all;">{{ trim($otpCode) }}</div>
            
            <p class="notice">
                Kode verifikasi ini berlaku selama <strong>15 menit</strong>.<br>
                Jangan berikan kode ini kepada siapapun demi keamanan akun Anda.<br>
                Jika Anda tidak merasa meminta kode ini, abaikan pesan ini.
            </p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Boutique Design Indonesia. Seluruh hak cipta dilindungi.
        </div>
    </div>
</body>
</html>
