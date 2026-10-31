@props([
    'title' => null,
    'description' => 'AL.GLOBAL OIL SH.A is an Albanian petroleum company, established in 2016, registered for the wholesale import, export and processing of hydrocarbons, fuels, gas and their by-products.',
    'image' => 'refinery-river',
    'type' => 'website',
    'breadcrumbs' => [],
    'canonical' => null,
    'schema' => null,
])

@php
    $company = config('company.name');
    $pageTitle = $title ? "{$title} | {$company}" : "{$company} | Petroleum Trading & Hydrocarbons in Albania";
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
    @if (config('site.noindex'))
        <meta name="robots" content="noindex, nofollow, noarchive">
    @endif

    <meta property="og:site_name" content="{{ $company }}">
    <meta property="og:type" content="{{ $type }}">
    <meta property="og:title" content="{{ $title ?? $company }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:locale" content="en_GB">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? $company }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <meta name="theme-color" content="#0f0f0d">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <script>
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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-partials.schema :breadcrumbs="$breadcrumbs" :extra="$schema" />
</head>
<body class="min-h-dvh">
    <a href="#main" class="sr-only z-[200] bg-accent px-4 py-3 font-semibold text-ink focus:not-sr-only focus:fixed focus:top-3 focus:left-3">Skip to content</a>

    <x-partials.header />

    <main id="main" tabindex="-1" class="outline-none">
        {{ $slot }}
    </main>

    <x-partials.footer />
    <x-partials.cookie-consent />

    <div class="page-curtain" aria-hidden="true"></div>
</body>
</html>
