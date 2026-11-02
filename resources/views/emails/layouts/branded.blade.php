{{--
    Branded HTML email layout: dark header with the logo, white content card,
    company footer. Table-based with inline styles for wide email-client
    support. The logo is embedded in the message (CID) so it displays even
    when remote images are blocked; outside a mail send it falls back to the public URL.
--}}
@php
    $logoPath = public_path('images/brand/email-logo.png');
    $logo = isset($message) ? $message->embed($logoPath) : asset('images/brand/email-logo.png');
    $hq = config('company.locations.tirana.lines');
    $email = config('company.contact.email');
    $site = rtrim(config('app.url'), '/');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>@yield('title')</title>
</head>
<body style="margin:0;padding:0;background:#f3f3ee;-webkit-text-size-adjust:100%;">
    {{-- Inbox preview text --}}
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;font-size:1px;line-height:1px;color:#f3f3ee;">@yield('preheader')</div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f3f3ee;">
        <tr>
            <td align="center" style="padding:32px 12px;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:600px;">

                    {{-- Header --}}
                    <tr>
                        <td style="background:#1b1b19;padding:28px 36px;">
                            <img src="{{ $logo }}" width="183" height="40" alt="AL.GLOBAL OIL SH.A" style="display:block;border:0;outline:none;width:183px;height:40px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#1b1b19;font-size:0;line-height:0;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td width="25%" style="height:4px;background:#e2e890;font-size:0;line-height:0;">&nbsp;</td>
                                    <td width="75%" style="height:4px;background:#1b1b19;font-size:0;line-height:0;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Content --}}
                    <tr>
                        <td style="background:#ffffff;padding:40px 36px 36px;font-family:Arial,Helvetica,sans-serif;color:#1b1b19;font-size:15px;line-height:1.6;">
                            @yield('content')
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background:#ffffff;border-top:1px solid #e4e4dc;padding:24px 36px 28px;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:1.7;color:#565659;">
                            <strong style="color:#1b1b19;">{{ config('company.name') }}</strong><br>
                            {{ implode(', ', array_map(fn ($line) => __($line), $hq)) }}<br>
                            @if ($email)
                                <a href="mailto:{{ $email }}" style="color:#545814;text-decoration:underline;">{{ $email }}</a> &nbsp;·&nbsp;
                            @endif
                            <a href="{{ $site }}" style="color:#545814;text-decoration:underline;">{{ preg_replace('#^https?://#', '', $site) }}</a><br>
                            NUIS {{ config('company.nuis') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:18px 36px 0;font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:1.6;color:#8a8a80;text-align:center;">
                            @yield('footnote')
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
