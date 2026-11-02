{{-- Internal notification to the company inbox for each form submission. --}}
@extends('emails.layouts.branded')

@section('title', $form)
@section('preheader', $form . ' from ' . $replyName)

@section('content')
    <p style="margin:0 0 6px;font-size:12px;letter-spacing:2px;text-transform:uppercase;color:#545814;font-weight:bold;">Website submission</p>
    <h1 style="margin:0 0 24px;font-size:24px;line-height:1.25;color:#1b1b19;">{{ $form }}</h1>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
        @foreach ($fields as $label => $value)
            <tr>
                <td valign="top" style="padding:11px 12px 11px 0;border-top:1px solid #e4e4dc;width:36%;font-size:13px;color:#565659;">{{ $label }}</td>
                <td valign="top" style="padding:11px 0;border-top:1px solid #e4e4dc;font-size:14px;color:#1b1b19;white-space:pre-line;">{{ filled($value) ? $value : '-' }}</td>
            </tr>
        @endforeach
    </table>

    <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin-top:28px;">
        <tr>
            <td style="background:#1b1b19;">
                <a href="mailto:{{ $replyEmail }}" style="display:inline-block;padding:12px 22px;font-size:14px;font-weight:bold;color:#e2e890;text-decoration:none;">Reply to {{ $replyName }}</a>
            </td>
        </tr>
    </table>
@endsection

@section('footnote')
    Sent from the contact forms on the {{ config('company.name') }} website. Replying to this email answers the sender directly.
@endsection
