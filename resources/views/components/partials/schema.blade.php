@props([
    'breadcrumbs' => [],
    'extra' => null,
])

@php
    $hq = config('company.locations.tirana');

    $graph = [
        [
            '@type' => 'Organization',
            '@id' => url('/') . '#organization',
            'name' => config('company.name'),
            'alternateName' => config('company.trading_name'),
            'url' => url('/'),
            'logo' => asset('images/brand/logo-mark.svg'),
            'foundingDate' => config('company.founded'),
            'taxID' => config('company.nuis'),
            'description' => config('company.registered_activity'),
            'telephone' => config('company.contact.phones')[0] ?? null,
            'email' => config('company.contact.email'),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Rruga "Sulejman Delvina", Ndërtesa 11, Hyrja 10, Ap. 7',
                'postalCode' => '1019',
                'addressLocality' => 'Tirana',
                'addressCountry' => 'AL',
            ],
        ],
    ];

    if (count($breadcrumbs)) {
        $items = [['name' => 'Home', 'url' => route('home')], ...$breadcrumbs];
        $graph[] = [
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($items)->values()->map(fn ($crumb, $i) => [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $crumb['name'],
                'item' => $crumb['url'] ?? url()->current(),
            ])->all(),
        ];
    }

    if ($extra) {
        $graph[] = $extra;
    }

    $json = [
        '@context' => 'https://schema.org',
        '@graph' => collect($graph)->map(fn ($node) => array_filter($node, fn ($v) => $v !== null))->all(),
    ];
@endphp

<script type="application/ld+json">{!! json_encode($json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
