@php
    $services = [
        [
            'id' => 'hydrocarbons',
            'eyebrow' => '01 · Trading',
            'title' => 'Petroleum and hydrocarbon trading',
            'text' => 'Wholesale trading in hydrocarbons of all kinds is the foundation of our registered activity. We work with suppliers and commercial buyers to move product efficiently and in full compliance with applicable regulations.',
            'points' => ['Wholesale transactions with commercial counterparties', 'Hydrocarbons of all kinds within registered scope', 'Contracted terms covering volumes, pricing basis and delivery'],
            'image' => 'tanks-sky',
            'link' => 'trading',
        ],
        [
            'id' => 'fuels',
            'eyebrow' => '02 · Products',
            'title' => 'Fuel and petroleum products',
            'text' => 'We are registered to trade fuels and petroleum products on a wholesale basis for commercial and industrial customers. Product grades, specifications and availability are confirmed for each inquiry.',
            'points' => ['Fuels and refined petroleum products', 'Product documentation provided with supply', 'Availability confirmed on inquiry'],
            'image' => 'truck-road',
            'link' => null,
        ],
        [
            'id' => 'gas',
            'eyebrow' => '03 · Gas',
            'title' => 'Gas and related products',
            'text' => 'Our registered activities include gas and its by-products. We discuss gas-related requirements with partners on a case-by-case basis, in line with the licences and permits that apply.',
            'points' => ['Gas and gas by-products within registered scope', 'Requirements assessed individually', 'Handled in line with safety regulations'],
            'image' => 'industrial-steam',
            'link' => null,
        ],
        [
            'id' => 'import-export',
            'eyebrow' => '04 · Cross-border',
            'title' => 'Import and export',
            'text' => 'Import and export of hydrocarbons, fuels, oil, gas and their by-products is central to our registration. Our registered location at the Porto Romano hydrocarbons terminal sits on Albania’s Adriatic coast.',
            'points' => ['Import and export of petroleum products', 'Customs and documentation handled with care', 'Registered location at Porto Romano, Durrës'],
            'image' => 'ship-sea',
            'link' => 'trading',
        ],
        [
            'id' => 'processing',
            'eyebrow' => '05 · Processing',
            'title' => 'Petroleum processing',
            'text' => 'Since 2018 our registered object of activity has included the processing of crude oil and its by-products. Details of any current processing operations are provided directly on request.',
            'points' => ['Crude oil processing within registered scope', 'Petroleum by-products and derivatives', 'Operational details confirmed on request'],
            'image' => 'refinery-night',
            'link' => 'processing',
        ],
    ];
@endphp

<x-layouts.app
    title="Products & Services"
    description="Petroleum and hydrocarbon trading, fuels and petroleum products, gas, import and export, and petroleum processing: the registered activities of AL.GLOBAL OIL SH.A in Albania."
    image="tanks-sky"
    :breadcrumbs="[['name' => 'Business'], ['name' => 'Products & Services']]"
>
    <x-sections.page-hero
        eyebrow="Products & Services"
        title="Hydrocarbons, fuels, gas and petroleum derivatives"
        lead="An overview of the activities AL.GLOBAL OIL SH.A is registered to carry out, from wholesale trading to crude oil processing."
        image="tanks-sky"
        :breadcrumbs="[['name' => 'Business'], ['name' => 'Products & Services']]"
    />

    {{-- In-page index --}}
    <nav aria-label="On this page" class="sticky top-0 z-30 hidden border-b border-line bg-paper/90 backdrop-blur-lg md:block">
        <div class="container-site flex gap-8 overflow-x-auto py-5 text-sm font-medium text-stone">
            @foreach ($services as $service)
                <a href="#{{ $service['id'] }}" class="shrink-0 hover:text-ink-2">{{ $service['title'] }}</a>
            @endforeach
        </div>
    </nav>

    <section class="section-tight bg-paper">
        <div class="container-site">
            <div class="flex flex-col gap-6 border-b border-line pb-12 lg:flex-row lg:items-end lg:justify-between">
                <p class="max-w-2xl text-lead text-stone" data-reveal>
                    The services below reflect our registered object of activity and wholesale trading licence. We do not publish a fixed product catalogue: grades, specifications, quantities and availability are confirmed individually for every inquiry.
                </p>
                <div data-reveal><x-confirm>Detailed product catalogue to be confirmed by the company</x-confirm></div>
            </div>
        </div>
    </section>

    @foreach ($services as $service)
        <section id="{{ $service['id'] }}" class="pb-20 sm:pb-28 lg:pb-36 {{ $loop->first ? 'bg-paper' : 'bg-paper' }}">
            <div class="container-site">
                <x-sections.split :image="$service['image']" :reverse="$loop->even" ratio="aspect-[4/3] lg:aspect-[5/4]">
                    <p class="eyebrow" data-reveal>{{ $service['eyebrow'] }}</p>
                    <h2 class="text-h2 mt-6" data-split>{{ $service['title'] }}</h2>
                    <p class="lead mt-6" data-reveal>{{ $service['text'] }}</p>
                    <ul class="mt-10 space-y-4" data-stagger>
                        @foreach ($service['points'] as $point)
                            <li class="flex gap-4 border-b border-line pb-4">
                                <span class="mt-2 size-2 shrink-0 bg-accent-strong" aria-hidden="true"></span>
                                <span class="text-ink-2">{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-10 flex flex-wrap gap-3" data-reveal>
                        <x-buttons.primary :href="route('inquiry', ['type' => 'purchase'])" variant="dark">Make an Inquiry</x-buttons.primary>
                        @if ($service['link'])
                            <x-buttons.primary :href="route($service['link'])" variant="outline">Learn More</x-buttons.primary>
                        @endif
                    </div>
                </x-sections.split>
            </div>
        </section>
    @endforeach

    <x-sections.cta
        eyebrow="Business inquiry"
        title="Tell us what your business needs"
        text="Share your product requirements and indicative volumes, and our commercial team will respond with availability and terms."
        image="tanker-sea"
        :primary="['label' => 'Start a Business Inquiry', 'route' => 'inquiry']"
        :secondary="['label' => 'Contact Our Team', 'route' => 'contact']"
    />
</x-layouts.app>
