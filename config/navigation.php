<?php

/*
|--------------------------------------------------------------------------
| Primary navigation
|--------------------------------------------------------------------------
|
| Drives the desktop header, mega menus, mobile menu and footer. Each item
| references a named route; groups render as dropdown panels.
|
*/

return [

    ['label' => 'Home', 'route' => 'home'],
    ['label' => 'About Us', 'route' => 'about'],
    [
        'label' => 'Business',
        'intro' => 'Registered activities across the petroleum value chain, from trading to processing and infrastructure.',
        'children' => [
            ['label' => 'Products & Services', 'route' => 'services', 'image' => 'tanks-field', 'text' => 'Hydrocarbons, fuels, gas and derivatives'],
            ['label' => 'Petroleum Trading', 'route' => 'trading', 'image' => 'tanker-red', 'text' => 'Import, export and wholesale supply'],
            ['label' => 'Refining & Processing', 'route' => 'processing', 'image' => 'refinery-night', 'text' => 'Crude oil and by-product processing'],
            ['label' => 'Infrastructure', 'route' => 'infrastructure', 'image' => 'port-tanks', 'text' => 'Tirana, Fier and Porto Romano'],
        ],
    ],
    [
        'label' => 'Responsibility',
        'intro' => 'How we approach health, safety, the environment and long-term value.',
        'children' => [
            ['label' => 'Health, Safety & Environment', 'route' => 'hse', 'image' => 'engineer-hardhat', 'text' => 'Principles, permits and commitments'],
            ['label' => 'Sustainability', 'route' => 'sustainability', 'image' => 'tank-water', 'text' => 'Responsible, long-term operations'],
        ],
    ],
    ['label' => 'Careers', 'route' => 'careers'],
    ['label' => 'News', 'route' => 'news.index'],

];
