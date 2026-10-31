@props(['size' => 'sm']) {{-- sm: header bar, lg: mobile menu --}}

@php
    $current = app()->getLocale();
@endphp

<nav aria-label="{{ __('Language') }}" {{ $attributes->class(['flex items-center ring-1 ring-white/20 ring-inset', $size === 'lg' ? 'h-12' : 'h-12 bg-white/5 backdrop-blur-md']) }}>
    @foreach (config('site.locales') as $code => $locale)
        <a
            href="{{ locale_switch_url($code) }}"
            hreflang="{{ $code }}"
            lang="{{ $code }}"
            title="{{ $locale['name'] }}"
            @if ($code === $current) aria-current="true" @endif
            class="relative grid h-full place-items-center text-[0.8125rem] font-semibold tracking-[0.08em] transition-colors duration-300 {{ $size === 'lg' ? 'px-5' : 'px-3 sm:px-3.5' }} {{ $code === $current ? 'bg-white text-ink' : 'text-white/70 hover:text-white' }}"
        >
            <span aria-hidden="true">{{ $locale['short'] }}</span>
            <span class="sr-only">{{ $locale['name'] }}</span>
        </a>
    @endforeach
</nav>
