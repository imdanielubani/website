{{ __('We have received your message') }}

{{ __('Dear :name,', ['name' => $name]) }}

{{ __('Thank you for contacting :company. Your message has been received and a member of our team will reply as soon as possible.', ['company' => config('company.name')]) }}

{{ __('Inquiry type') }}: {{ __($inquiryType) }}
{{ __('Received') }}: {{ $receivedAt }}

{{ __('If you need to add anything, simply reply to this email.') }}

{{ __('Kind regards,') }}
{{ config('company.name') }}
{{ implode(', ', array_map(fn ($line) => __($line), config('company.locations.tirana.lines'))) }}
@if (config('company.contact.email'))
{{ config('company.contact.email') }}
@endif
