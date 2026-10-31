@props([
    'title' => null,
    'description' => null,
    'image' => 'refinery-river',
    'type' => 'website',
    'breadcrumbs' => [],
    'canonical' => null,
    'schema' => null,
])

@php
    $company = config('company.name');
    $title = $title ? t($title) : null;
    $description = $description ? t($description) : null;
    $breadcrumbs = array_map(fn ($crumb) => ['name' => t($crumb['name'])] + $crumb, $breadcrumbs);
    $description ??= __('AL.GLOBAL OIL SH.A is an Albanian petroleum company, established in 2016, registered for the wholesale import, export and processing of hydrocarbons, fuels, gas and their by-products.');
    $pageTitle = $title ? "{$title} | {$company}" : $company . ' | ' . __('Petroleum Trading & Hydrocarbons in Albania');
    $locales = config('site.locales');
    $canonicalUrl = $canonical ?? url()->current();
    $ogImage = asset('images/photos/' . config("images.{$image}.file") . '-lg.webp');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    @foreach ($locales as $code => $locale)
        <link rel="alternate" hreflang="{{ $code }}" href="{{ locale_switch_url($code) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ locale_switch_url(config('site.default_locale')) }}">
    @if (config('site.noindex'))
        <meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    @endif

    <meta property="og:site_name" content="{{ $company }}">
    <meta property="og:type" content="{{ $type }}">
    <meta property="og:title" content="{{ $title ?? $company }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:locale" content="{{ $locales[app()->getLocale()]['og'] }}">
    @foreach ($locales as $code => $locale)
        @if ($code !== app()->getLocale())
            <meta property="og:locale:alternate" content="{{ $locale['og'] }}">
        @endif
    @endforeach
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? $company }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <meta name="theme-color" content="#0f0f0d">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="apple-mobile-web-app-title" content="AL.GLOBAL">

    <script nonce="{{ \Illuminate\Support\Facades\Vite::cspNonce() }}">
        (function () {
            var d = document.documentElement;
            d.classList.replace('no-js', 'js');
            try {
                if (sessionStorage.getItem('pt') === '1') {
                    sessionStorage.removeItem('pt');
                    d.classList.add('is-transitioning');
                    // Safety net: never leave the curtain covering the page.
                    setTimeout(function () { d.classList.remove('is-transitioning'); }, 1600);
                }
            } catch (e) {}
        })();
    </script>

    {{-- Fetch the two main typefaces in parallel with the stylesheet so headings render in the brand font sooner. --}}
    @foreach (['manrope', 'inter'] as $font)
        <link rel="preload" href="{{ \Illuminate\Support\Facades\Vite::asset("node_modules/@fontsource-variable/{$font}/files/{$font}-latin-wght-normal.woff2") }}" as="font" type="font/woff2" crossorigin>
    @endforeach

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-partials.schema :breadcrumbs="$breadcrumbs" :extra="$schema" />
</head>
<body class="min-h-dvh">
    <a href="#main" class="sr-only z-[200] bg-accent px-4 py-3 font-semibold text-ink focus:not-sr-only focus:fixed focus:top-3 focus:left-3">{{ __('Skip to content') }}</a>

    <x-partials.header />

    <main id="main" tabindex="-1" class="outline-none">
        {{ $slot }}
    </main>

    <x-partials.footer />
    <x-partials.cookie-consent />

    <div class="page-curtain" aria-hidden="true"></div>
</body>
</html>
