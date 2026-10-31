@props([
    'href',
    'variant' => 'primary', // primary | dark | ghost | outline
])

<a href="{{ $href }}" {{ $attributes->class(['btn', "btn-{$variant}"]) }}>
    <span>{{ t($slot) }}</span>
    <span class="btn-arrow" aria-hidden="true">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 8h10M9 4l4 4-4 4" /></svg>
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 8h10M9 4l4 4-4 4" /></svg>
    </span>
</a>
