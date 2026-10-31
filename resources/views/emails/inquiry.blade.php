<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $form }}</title>
</head>
<body style="margin:0;background:#f6f6f6;font-family:Arial,Helvetica,sans-serif;color:#1b1b19;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f6f6f6;padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;">
                    <tr>
                        <td style="background:#1b1b19;padding:24px 32px;color:#ffffff;font-size:18px;font-weight:bold;letter-spacing:-0.3px;">
                            AL.GLOBAL <span style="color:#e2e890;">OIL</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0 0 4px;font-size:12px;letter-spacing:2px;text-transform:uppercase;color:#565659;">Website submission</p>
                            <h1 style="margin:0 0 24px;font-size:22px;">{{ $form }}</h1>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                @foreach ($fields as $label => $value)
                                    <tr>
                                        <td style="padding:10px 0;border-top:1px solid #e4e4dc;width:38%;vertical-align:top;font-size:13px;color:#565659;">{{ $label }}</td>
                                        <td style="padding:10px 0;border-top:1px solid #e4e4dc;vertical-align:top;font-size:14px;white-space:pre-line;">{{ filled($value) ? $value : '-' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <p style="margin:24px 0 0;font-size:12px;color:#565659;">Reply directly to this email to respond to {{ $replyName }}.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
