{{ $form }} — {{ config('company.name') }} website

@foreach ($fields as $label => $value)
{{ $label }}: {{ filled($value) ? $value : '-' }}
@endforeach

Reply to this email to answer {{ $replyName }} directly.
