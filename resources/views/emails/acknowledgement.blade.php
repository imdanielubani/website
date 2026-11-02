{{--
    Confirmation sent to the visitor after a successful submission, in the
    language they used. It deliberately does not repeat the visitor's
    message, so the form cannot be abused to send arbitrary text to others.
--}}
@extends('emails.layouts.branded')

@section('title', __('We have received your message'))
@section('preheader', __('Thank you for contacting :company. Our team will reply soon.', ['company' => config('company.name')]))

@section('content')
    <p style="margin:0 0 6px;font-size:12px;letter-spacing:2px;text-transform:uppercase;color:#545814;font-weight:bold;">{{ __($form) }}</p>
    <h1 style="margin:0 0 20px;font-size:24px;line-height:1.25;color:#1b1b19;">{{ __('We have received your message') }}</h1>

    <p style="margin:0 0 16px;">{{ __('Dear :name,', ['name' => $name]) }}</p>
    <p style="margin:0 0 16px;">{{ __('Thank you for contacting :company. Your message has been received and a member of our team will reply as soon as possible.', ['company' => config('company.name')]) }}</p>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:24px 0;background:#f9f9e9;border-left:3px solid #d4dc6a;">
        <tr>
            <td style="padding:16px 18px;font-size:14px;">
                <span style="color:#565659;">{{ __('Inquiry type') }}:</span>
                <strong style="color:#1b1b19;">{{ __($inquiryType) }}</strong><br>
                <span style="color:#565659;">{{ __('Received') }}:</span>
                <strong style="color:#1b1b19;">{{ $receivedAt }}</strong>
            </td>
        </tr>
    </table>

    <p style="margin:0 0 16px;">{{ __('If you need to add anything, simply reply to this email.') }}</p>
    <p style="margin:24px 0 0;">{{ __('Kind regards,') }}<br><strong>{{ config('company.name') }}</strong></p>
@endsection

@section('footnote')
    {{ __('You are receiving this email because this address was entered in a form on our website. If this was not you, you can ignore this message.') }}
@endsection
