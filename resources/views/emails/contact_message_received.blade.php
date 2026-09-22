<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Masuk Baru dari Website</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 30px 15px;
            color: #334155;
            -webkit-font-smoothing: antialiased;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }
        .email-header {
            background: #c62828;
            padding: 32px 24px;
            text-align: center;
            color: #ffffff;
        }
        .header-title {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 1px;
            margin: 0 0 6px 0;
            text-transform: uppercase;
        }
        .header-subtitle {
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0.92;
            margin: 0;
            color: #fee2e2;
        }
        .email-body {
            padding: 36px 30px;
        }
        .alert-badge {
            display: inline-block;
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .intro-text {
            font-size: 16px;
            color: #1e293b;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 28px;
        }
        .info-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #edf2f7;
            font-size: 14px;
        }
        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .info-row:first-child {
            padding-top: 0;
        }
        .info-label {
            width: 140px;
            font-weight: 600;
            color: #64748b;
            flex-shrink: 0;
        }
        .info-value {
            color: #0f172a;
            font-weight: 500;
            word-break: break-word;
        }
        .info-value a {
            color: #c62828;
            text-decoration: none;
            font-weight: 600;
        }
        .info-value a:hover {
            text-decoration: underline;
        }
        .message-box {
            background: #ffffff;
            border: 2px solid #fee2e2;
            border-left: 5px solid #c62828;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .message-box-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #c62828;
            margin-bottom: 12px;
        }
        .message-box-content {
            font-size: 15px;
            line-height: 1.7;
            color: #1e293b;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .actions-wrapper {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }
        .btn-action {
            display: inline-block;
            background: #c62828;
            color: #ffffff !important;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            margin: 6px 4px;
            transition: all 0.2s ease;
        }
        .btn-action-secondary {
            display: inline-block;
            background: #25d366;
            color: #ffffff !important;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            margin: 6px 4px;
        }
        .email-footer {
            background: #f8fafc;
            padding: 24px 20px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h1 class="header-title">Boutique Design Indonesia</h1>
            <p class="header-subtitle">Pemberitahuan Pesan Masuk Baru</p>
        </div>

        <div class="email-body">
            <div class="alert-badge">Pesan Baru dari Website</div>
            
            <p class="intro-text">
                Halo Admin, Anda baru saja menerima pesan baru dari calon klien / pengunjung website <strong>Boutique Design Indonesia</strong>. Berikut rinciannya:
            </p>

            <div class="info-card">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="border-bottom: 1px solid #edf2f7;">
                        <td style="padding: 10px 0; font-weight: 600; color: #64748b; width: 140px;">Nama Pengirim</td>
                        <td style="padding: 10px 0; color: #0f172a; font-weight: 700;">{{ $msg->name }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #edf2f7;">
                        <td style="padding: 10px 0; font-weight: 600; color: #64748b;">Alamat Email</td>
                        <td style="padding: 10px 0;">
                            <a href="mailto:{{ $msg->email }}" style="color: #c62828; text-decoration: none; font-weight: 600;">{{ $msg->email }}</a>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #edf2f7;">
                        <td style="padding: 10px 0; font-weight: 600; color: #64748b;">Nomor Telepon</td>
                        <td style="padding: 10px 0; color: #0f172a; font-weight: 600;">
                            @php
                                $cleanPhone = preg_replace('/[^0-9]/', '', $msg->phone);
                                if (substr($cleanPhone, 0, 1) === '0') {
                                    $cleanPhone = '62' . substr($cleanPhone, 1);
                                } elseif (substr($cleanPhone, 0, 2) !== '62') {
                                    $cleanPhone = '62' . $cleanPhone;
                                }
                            @endphp
                            <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" style="color: #059669; text-decoration: none;">{{ $msg->phone }} (Klik untuk Chat WA)</a>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #edf2f7;">
                        <td style="padding: 10px 0; font-weight: 600; color: #64748b;">Subjek</td>
                        <td style="padding: 10px 0; color: #0f172a;">{{ $msg->subject ?: 'Inquiry dari Website' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; font-weight: 600; color: #64748b;">Waktu Masuk</td>
                        <td style="padding: 10px 0; color: #64748b;">{{ $msg->created_at ? $msg->created_at->format('d M Y, H:i') . ' WIB' : date('d M Y, H:i') . ' WIB' }}</td>
                    </tr>
                </table>
            </div>

            <div class="message-box">
                <div class="message-box-title">Isi Pesan Pengirim:</div>
                <div class="message-box-content">{!! nl2br(e($msg->message)) !!}</div>
            </div>

            <div class="actions-wrapper">
                <a href="mailto:{{ $msg->email }}?subject=Re:%20{{ urlencode($msg->subject ?: 'Inquiry Boutique Design') }}" class="btn-action">
                    Balas Email Ini Langsung
                </a>
                <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode('Halo ' . $msg->name . ', terima kasih telah menghubungi Boutique Design Indonesia terkait pesan Anda.') }}" target="_blank" class="btn-action-secondary">
                    Chat via WhatsApp
                </a>
            </div>
        </div>

        <div class="email-footer">
            Email ini dikirimkan secara otomatis oleh sistem Company Profile Boutique Design Indonesia ke seluruh email admin terdaftar.<br>
            &copy; {{ date('Y') }} Boutique Design Indonesia. All rights reserved.
        </div>
    </div>
</body>
</html>
