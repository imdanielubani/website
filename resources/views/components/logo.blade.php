@props([
    'tone' => 'dark', // "dark" for use on dark backgrounds, "light" for light backgrounds
    'href' => null,
])

@php
    $maskId = 'logo-mask-' . \Illuminate\Support\Str::random(6);
    $tile = $tone === 'dark' ? 'var(--color-accent)' : 'var(--color-ink-2)';
    $drop = $tone === 'dark' ? 'var(--color-ink-2)' : 'var(--color-accent)';
    $tag = $href ? 'a' : 'span';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" aria-label="{{ __(':company home', ['company' => config('company.name')]) }}" @endif
    {{ $attributes->class(['inline-flex items-center gap-3', $tone === 'dark' ? 'text-white' : 'text-ink-2']) }}
>
    <svg viewBox="0 0 40 40" class="size-10 shrink-0" aria-hidden="true" focusable="false">
        <mask id="{{ $maskId }}">
            <rect width="40" height="40" fill="#fff" />
            <rect y="19.4" width="40" height="1.9" fill="#000" />
            <rect y="24.6" width="40" height="1.9" fill="#000" />
            <rect y="29.8" width="40" height="1.9" fill="#000" />
        </mask>
        <rect width="40" height="40" style="fill: {{ $tile }}" />
        <path d="M20 4.5C20 4.5 8.5 17.4 8.5 24.6a11.5 11.5 0 0 0 23 0C31.5 17.4 20 4.5 20 4.5Z" style="fill: {{ $drop }}" mask="url(#{{ $maskId }})" />
    </svg>
    <span class="flex flex-col leading-none">
        <span class="font-display text-[1.32rem] font-extrabold tracking-[-0.045em]">AL.GLOBAL</span>
        <span class="mt-1 text-[0.58rem] font-semibold tracking-[0.36em] opacity-70">OIL SH.A</span>
    </span>
</{{ $tag }}>
