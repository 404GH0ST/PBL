@php
    $contact = \App\Models\Contact::active();
    $logoUrl = null;

    if ($contact && $contact->logo) {
        if (\Illuminate\Support\Str::startsWith($contact->logo, ['http://', 'https://'])) {
            $logoUrl = $contact->logo;
        } else {
            $logoUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($contact->logo);
        }
    }

    // Check if the logo URL is local
    $isLocalLogo = false;
    if ($logoUrl) {
        $host = parse_url($logoUrl, PHP_URL_HOST);
        if (!$host || in_array($host, ['localhost', '127.0.0.1', '::1']) || \Illuminate\Support\Str::endsWith($host, '.test')) {
            $isLocalLogo = true;
        }
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; width: 100% !important;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; padding: 40px 10px;">
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Header with Solid Color & Logo -->
                    <tr>
                        <td style="background-color: #4f46e5; padding: 40px 40px 30px 40px; text-align: center;">
                            <!-- Deenhag Logo -->
                            <div style="margin-bottom: 20px; text-align: center;">
                                @if ($logoUrl && !$isLocalLogo && !app()->isLocal())
                                    <img src="{{ $logoUrl }}" alt="Deenhag Logo" style="width: 64px; height: 64px; border-radius: 50%; object-fit: contain; background-color: #ffffff; padding: 4px; display: inline-block; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.15); border: 0; outline: none;">
                                @else
                                    <!-- Elegant HTML-only Logo for Local Dev / Fallback (No broken image icons!) -->
                                    <div style="width: 64px; height: 64px; border-radius: 50%; background-color: #ffffff; display: inline-block; text-align: center; vertical-align: middle; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.15);">
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
                                            <tr>
                                                <td align="center" valign="middle" style="font-size: 30px; font-weight: 900; color: #4f46e5; font-family: 'DM Sans', 'Inter', Arial, sans-serif; line-height: 1;">
                                                    D
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            
                            <span style="background-color: rgba(255, 255, 255, 0.15); color: #ffffff; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; padding: 6px 16px; border-radius: 50px; display: inline-block; margin-bottom: 20px;">
                                Kontak Masuk
                            </span>
                            <h1 style="color: #ffffff; margin: 0; font-size: 26px; font-weight: 800; letter-spacing: -0.5px; line-height: 32px;">
                                Pesan Baru untuk Deenhag
                            </h1>
                            <p style="color: #e0e7ff; margin: 8px 0 0 0; font-size: 15px; font-weight: 400;">
                                Ada pesan baru dari formulir kontak website Anda
                            </p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px; background-color: #ffffff;">
                            
                            <!-- Sender Card -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding-bottom: 12px; border-bottom: 1px solid #e2e8f0;">
                                        <span style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; display: block; margin-bottom: 4px; letter-spacing: 0.5px;">Nama Pengirim</span>
                                        <span style="font-size: 16px; font-weight: 700; color: #1e293b;">{{ $data['nama'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 12px;">
                                        <span style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; display: block; margin-bottom: 4px; letter-spacing: 0.5px;">Email Pengirim</span>
                                        <a href="mailto:{{ $data['email'] }}" style="font-size: 16px; font-weight: 600; color: #4f46e5; text-decoration: none;">{{ $data['email'] }}</a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Message Section -->
                            <div style="margin-bottom: 35px;">
                                <h3 style="font-size: 13px; font-weight: 700; color: #475569; text-transform: uppercase; margin-top: 0; margin-bottom: 12px; letter-spacing: 0.5px;">
                                    Isi Pesan:
                                </h3>
                                <div style="font-size: 15px; line-height: 24px; color: #334155; background-color: #fffbeb; border-left: 4px solid #f59e0b; padding: 18px 20px; border-radius: 0 8px 8px 0; font-style: italic; font-family: Georgia, serif;">
                                    "{!! nl2br(e($data['pesan'])) !!}"
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <a href="mailto:{{ $data['email'] }}" style="background-color: #4f46e5; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 700; padding: 14px 32px; border-radius: 8px; display: inline-block; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2), 0 2px 4px -2px rgba(79, 70, 229, 0.2);">
                                            Balas Email Sekarang
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #f1f5f9; padding: 30px 40px; text-align: center;">
                            <p style="margin: 0; font-size: 13px; color: #64748b; font-weight: 500;">
                                Email ini dikirim secara otomatis dari website <strong style="color: #475569;">{{ config('app.name') }}</strong>.
                            </p>
                            <p style="margin: 6px 0 0 0; font-size: 11px; color: #94a3b8;">
                                &copy; {{ date('Y') }} Deenhag. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
