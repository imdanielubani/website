@props([
    'key',
    'sizes' => '100vw',
    'eager' => false,
    'alt' => null,
])

@php
    $image = config("images.{$key}");
    $base = asset('images/photos/' . $image['file']);
@endphp

<img
    src="{{ $base }}-lg.webp"
    srcset="{{ $base }}-sm.webp 960w, {{ $base }}-lg.webp {{ $image['w'] }}w"
    sizes="{{ $sizes }}"
    width="{{ $image['w'] }}"
    height="{{ $image['h'] }}"
    alt="{{ $alt ?? __($image['alt']) }}"
    decoding="async"
    @if ($eager) fetchpriority="high" @else loading="lazy" @endif
    {{ $attributes->class(['size-full object-cover']) }}
>
