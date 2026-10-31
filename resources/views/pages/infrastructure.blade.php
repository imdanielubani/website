@php
    $locations = config('company.locations');
    $details = [
        'tirana' => [
            'title' => 'Tirana headquarters',
            'text' => 'The company’s registered seat and central office in the Albanian capital, home to management, commercial and administrative functions.',
        ],
        'fier' => [
            'title' => 'Fier business location',
            'text' => 'A registered place of business at Drizë in the Fier region of south-western Albania, an area long associated with the country’s oil industry.',
        ],
        'durres' => [
            'title' => 'Durrës · Porto Romano',
            'text' => 'A registered place of business at the hydrocarbons terminal in the offshore customs zone of Porto Romano, on the Adriatic coast near Durrës.',
        ],
    ];
@endphp

<x-layouts.app
    title="Infrastructure & Facilities"
    description="AL.GLOBAL OIL SH.A registered locations: headquarters in Tirana and business locations in Fier and at the Porto Romano hydrocarbons terminal in Durrës, Albania."
    image="port-tanks"
    :breadcrumbs="[['name' => 'Business'], ['name' => 'Infrastructure']]"
>
    <x-sections.page-hero
        eyebrow="Infrastructure & Facilities"
        title="Rooted in three Albanian locations"
        lead="From the capital to the Adriatic coast, our registered locations connect commercial management with the movement of petroleum products."
        image="port-tanks"
        :breadcrumbs="[['name' => 'Business'], ['name' => 'Infrastructure']]"
    />

    {{-- Introduction --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <p class="eyebrow lg:col-span-3" data-reveal>Infrastructure</p>
                <div class="lg:col-span-9">
                    <p class="font-display text-[clamp(1.6rem,1.1rem+2vw,3rem)] leading-[1.18] font-medium tracking-[-0.03em]" data-split>
                        Our registered seat is in Tirana, with further registered places of business in Fier and at the Porto Romano hydrocarbons terminal in Durrës.
                    </p>
                    <p class="mt-10 max-w-2xl leading-relaxed text-stone" data-reveal>
                        The addresses below are as recorded in the Albanian business register. Facility specifications such as storage capacity, tank numbers and handling volumes are not published here and are shared directly once confirmed.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Locations --}}
    @foreach ($locations as $key => $location)
        <section id="{{ $key }}" class="pb-20 sm:pb-28 lg:pb-36 bg-paper">
            <div class="container-site">
                <div class="grid items-stretch gap-0 overflow-hidden bg-cream lg:grid-cols-12">
                    <div class="img-frame aspect-[4/3] lg:col-span-7 lg:aspect-auto lg:min-h-[34rem] {{ $loop->even ? 'lg:order-2' : '' }}" data-reveal="clip">
                        <div data-parallax="8" class="size-full">
                            <x-img :key="$location['image']" sizes="(min-width: 1024px) 58vw, 100vw" />
                        </div>
                        <span class="absolute top-6 left-6 bg-ink px-3 py-2 font-display text-sm font-semibold text-white">0{{ $loop->iteration }}</span>
                    </div>
                    <div class="flex flex-col justify-between p-8 sm:p-12 lg:col-span-5 lg:p-14">
                        <div>
                            <p class="text-xs font-semibold tracking-[0.16em] text-olive uppercase" data-reveal>{{ $location['label'] }}</p>
                            <h2 class="text-h3 mt-4" data-split>{{ $details[$key]['title'] }}</h2>
                            <p class="mt-5 leading-relaxed text-stone" data-reveal>{{ $details[$key]['text'] }}</p>
                        </div>
                        <div class="mt-10" data-reveal>
                            <div class="flex gap-4 border-t border-ink-2/10 pt-6">
                                <x-icon name="map-pin" class="mt-0.5 size-5 text-olive" />
                                <address class="text-sm leading-relaxed not-italic text-ink-2">
                                    {!! implode('<br>', array_map('e', $location['lines'])) !!}
                                </address>
                            </div>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($location['map_query']) }}" target="_blank" rel="noopener noreferrer" class="link-line mt-6 text-sm text-ink-2">
                                View area on Google Maps
                                <x-icon name="arrow-up-right" class="size-4" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    {{-- Industrial infrastructure --}}
    <section class="on-dark section bg-ink text-white">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Industrial infrastructure"
                title="Infrastructure information, verified before it is published"
                lead="This section is ready to present facility details as soon as they are confirmed. Until then, no capacities or specifications are shown."
            />
            <dl class="mt-16 grid gap-px border border-white/10 bg-white/10 sm:grid-cols-2 lg:mt-20 lg:grid-cols-4" data-stagger>
                @foreach ([
                    ['warehouse', 'Storage'],
                    ['ship', 'Marine access'],
                    ['truck', 'Road loading'],
                    ['gauge', 'Handling capacity'],
                ] as [$icon, $label])
                    <div class="bg-ink p-7 sm:p-8">
                        <x-icon :name="$icon" class="size-7 text-accent" />
                        <dt class="mt-8 font-display text-xl font-semibold tracking-[-0.02em]">{{ $label }}</dt>
                        <dd class="mt-4"><x-confirm>To be confirmed</x-confirm></dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    <x-sections.cta
        eyebrow="Facilities inquiry"
        title="Questions about our locations or facilities?"
        text="Contact us for information about logistics, storage or terminal-related services."
        image="tanks-field"
        :primary="['label' => 'Submit a Facilities Inquiry', 'route' => 'inquiry']"
        :secondary="['label' => 'Contact Our Team', 'route' => 'contact']"
    />
</x-layouts.app>
