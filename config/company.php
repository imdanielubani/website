<?php

/*
|--------------------------------------------------------------------------
| Company information
|--------------------------------------------------------------------------
|
| Single source of truth for company facts used across the site.
|
| Values marked "verified" are taken from the public Albanian business
| register (QKB) extract. Values set to null are awaiting confirmation by
| the company. Wherever a null value is rendered, the site shows a
| discreet "to be confirmed" placeholder instead of invented data.
|
*/

return [

    'name' => 'AL.GLOBAL OIL SH.A',
    'trading_name' => 'AL.GLOBAL OIL',
    'legal_form' => 'Shoqëri Aksionare (Joint-Stock Company)',

    // Verified: business register extract
    'nuis' => 'L62214509P',
    'founded' => '2016-10-11',
    'founded_year' => 2016,
    'registered' => '2016-10-14',

    // Verified: registered object of activity (translated from Albanian)
    'registered_activity' => 'Import and export of hydrocarbons of all kinds, fuels, oil, gas and their by-products on a wholesale basis, as well as the processing of crude oil and its by-products.',

    // Verified: licences and permits listed on the public register.
    // Confirm current validity with the company before relying on these.
    'licences' => [
        ['code' => 'VIII.1.A', 'title' => 'Wholesale trade of oil, gas and by-products, including bio-products and fuels'],
        ['code' => 'III.1.B', 'title' => 'Environmental Permit, Type B'],
        ['code' => 'III.1.C', 'title' => 'Environmental Permit, Type A'],
    ],

    'contact' => [
        // Verified: phone numbers listed on the public register
        'phones' => ['+355 68 204 4754', '+355 69 204 4754'],
        // Official company email
        'email' => env('COMPANY_EMAIL', 'info@alglobaloilsha.com'),
        'hours' => null,
    ],

    // Verified: registered seat and other places of business
    'locations' => [
        'tirana' => [
            'label' => 'Registered Headquarters',
            'city' => 'Tirana',
            'lines' => [
                'Rruga "Sulejman Delvina", Ndërtesa 11, Hyrja 10, Ap. 7',
                'Njësia Administrative Nr. 5',
                '1019 Tirana, Albania',
            ],
            'map_query' => 'Rruga Sulejman Delvina, Tirana, Albania',
            'image' => 'office-glass',
        ],
        'fier' => [
            'label' => 'Registered Business Location',
            'city' => 'Fier',
            'lines' => [
                'Drizë, Fier Qendër',
                'Property No. 184/4, Cadastral Zone 1557',
                'Fier, Albania',
            ],
            'map_query' => 'Drizë, Fier, Albania',
            'image' => 'industrial-steam',
        ],
        'durres' => [
            'label' => 'Registered Business Location',
            'city' => 'Durrës · Porto Romano',
            'lines' => [
                'Hydrocarbons Terminal, Offshore Customs Zone',
                'Porto Romano',
                'Durrës, Albania',
            ],
            'map_query' => 'Porto Romano, Durrës, Albania',
            'image' => 'port-tanks',
        ],
    ],

    'social' => [
        // Add profile URLs when available, e.g. 'linkedin' => 'https://...'
    ],

];
