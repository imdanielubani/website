@props(['name'])

{{-- Lucide icon placeholder; replaced with inline SVG by resources/js/icons.js --}}
<i data-lucide="{{ $name }}" aria-hidden="true" {{ $attributes->class(['inline-block size-5 shrink-0']) }}></i>
