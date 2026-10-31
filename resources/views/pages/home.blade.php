@php
    $business = collect(config('navigation'))->firstWhere('label', 'Business')['children'];
    $locations = config('company.locations');

    $products = [
        ['icon' => 'droplet', 'title' => 'Hydrocarbons', 'text' => 'Wholesale import and export of hydrocarbons of all kinds.'],
        ['icon' => 'fuel', 'title' => 'Fuels', 'text' => 'Trading in fuels and petroleum products for commercial customers.'],
        ['icon' => 'flame', 'title' => 'Gas', 'text' => 'Gas and gas-based products within registered activities.'],
        ['icon' => 'layers', 'title' => 'Petroleum derivatives', 'text' => 'By-products and derivatives of oil and gas.'],
        ['icon' => 'factory', 'title' => 'Crude oil processing', 'text' => 'Registered activity covering the processing of crude oil and its by-products.'],
    ];

    $values = [
        ['icon' => 'shield-check', 'title' => 'Safety first', 'text' => 'Protecting people, communities and the environment comes before every commercial objective.'],
        ['icon' => 'scale', 'title' => 'Integrity', 'text' => 'Transparent dealings, honest commitments and full respect for the law.'],
        ['icon' => 'handshake', 'title' => 'Partnership', 'text' => 'Long-term relationships built on reliability, fairness and clear communication.'],
        ['icon' => 'badge-check', 'title' => 'Compliance', 'text' => 'Operating within the licences, permits and regulations that govern our sector.'],
        ['icon' => 'gauge', 'title' => 'Reliability', 'text' => 'Doing what we say, when we say it, with disciplined planning and follow-through.'],
        ['icon' => 'leaf', 'title' => 'Responsibility', 'text' => 'Mindful of our environmental footprint and our role in Albania’s energy future.'],
    ];
@endphp

<x-layouts.app>

    {{-- Hero --}}
    <section data-hero class="on-dark relative isolate flex min-h-svh overflow-hidden bg-ink text-white">
        <div class="absolute inset-0 -z-10">
            <div data-hero-media class="size-full will-change-transform">
                <x-img key="refinery-river" eager sizes="100vw" alt="" />
            </div>
            <div class="overlay-hero absolute inset-0"></div>
        </div>

        <div class="container-site flex min-h-svh flex-col pt-32 pb-8 sm:pb-10">
            <div class="flex flex-1 flex-col justify-end pb-12 sm:pb-16">
                <p class="eyebrow mb-7 text-white/80" data-hero-item>Petroleum &amp; Hydrocarbons &middot; Albania</p>
                <h1 data-hero-title class="text-display max-w-[14ch] font-semibold">Reliable Energy. Stronger Partnerships.</h1>
                <div class="mt-10 grid gap-10 lg:grid-cols-12 lg:items-end">
                    <p class="lead max-w-xl lg:col-span-6" data-hero-item>
                        {{ config('company.name') }} is an Albanian petroleum company, established in {{ config('company.founded_year') }} and registered for the wholesale import, export and processing of hydrocarbons, fuels, gas and their by-products.
                    </p>
                    <div class="flex flex-wrap gap-3 lg:col-span-6 lg:justify-end" data-hero-item>
                        <x-buttons.primary :href="route('services')">Explore Our Business</x-buttons.primary>
                        <x-buttons.primary :href="route('contact')" variant="ghost">Contact Our Team</x-buttons.primary>
                    </div>
                </div>
            </div>

            <dl class="grid grid-cols-2 gap-px border-t border-white/15 pt-6 text-sm md:grid-cols-4" data-hero-item>
                <div class="pr-4 pb-4 md:pb-0">
                    <dt class="text-white/50">Established</dt>
                    <dd class="mt-1 font-display text-2xl font-semibold tracking-[-0.03em]"><span data-count="{{ config('company.founded_year') }}" data-count-from="1990">{{ config('company.founded_year') }}</span></dd>
                </div>
                <div class="pr-4 pb-4 md:pb-0">
                    <dt class="text-white/50">Headquarters</dt>
                    <dd class="mt-1 font-display text-2xl font-semibold tracking-[-0.03em]">Tirana</dd>
                </div>
                <div class="pr-4">
                    <dt class="text-white/50">Registered locations</dt>
                    <dd class="mt-1 font-display text-2xl font-semibold tracking-[-0.03em]">Tirana &middot; Fier &middot; Durrës</dd>
                </div>
                <div>
                    <dt class="text-white/50">Licensed activity</dt>
                    <dd class="mt-1 font-display text-2xl font-semibold tracking-[-0.03em]">Wholesale trade</dd>
                </div>
            </dl>
        </div>
    </section>

    {{-- Company introduction --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <p class="eyebrow" data-reveal>Who we are</p>
                    <div class="img-frame mt-10 hidden aspect-[3/4] lg:block" data-reveal="clip">
                        <div data-parallax="10" class="size-full">
                            <x-img key="pipes-valves" sizes="30vw" />
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-8">
                    <p class="font-display text-[clamp(1.6rem,1.1rem+2vw,3rem)] leading-[1.18] font-medium tracking-[-0.03em] text-ink-2" data-split>
                        An Albanian joint-stock company working across the petroleum value chain, with a registered headquarters in Tirana and business locations in Fier and at the Porto Romano hydrocarbons terminal in Durrës.
                    </p>
                    <div class="mt-14 grid gap-10 border-t border-line pt-10 sm:grid-cols-2">
                        <p class="leading-relaxed text-stone" data-reveal>
                            Since {{ config('company.founded_year') }}, AL.GLOBAL OIL has been registered to import and export hydrocarbons, fuels, oil, gas and their by-products on a wholesale basis, and to process crude oil and its derivatives.
                        </p>
                        <p class="leading-relaxed text-stone" data-reveal data-delay="0.1">
                            We approach every relationship with the seriousness our sector demands: clear commitments, regulatory compliance and a disciplined approach to health, safety and the environment.
                        </p>
                    </div>
                    <div class="mt-10 flex flex-wrap items-center gap-x-10 gap-y-5" data-reveal>
                        <x-buttons.primary :href="route('about')" variant="dark">About the Company</x-buttons.primary>
                        <dl class="flex gap-10 text-sm">
                            <div>
                                <dt class="text-stone">NUIS</dt>
                                <dd class="mt-1 font-semibold tracking-wide">{{ config('company.nuis') }}</dd>
                            </div>
                            <div>
                                <dt class="text-stone">Legal form</dt>
                                <dd class="mt-1 font-semibold">Joint-stock company (SH.A)</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Marquee --}}
    <section class="overflow-hidden border-y border-line bg-cream py-8 sm:py-10" data-marquee aria-label="Registered activities">
        <div class="marquee-track font-display text-[clamp(2.25rem,1.5rem+3vw,5rem)] font-semibold tracking-[-0.04em] text-ink-2">
            @foreach (range(1, 2) as $i)
                @foreach (['Hydrocarbons', 'Fuels', 'Gas', 'Petroleum Derivatives', 'Import & Export', 'Wholesale Trade', 'Crude Oil Processing'] as $word)
                    <span @if ($i > 1) aria-hidden="true" @endif>{{ $word }}</span>
                    <span class="inline-block size-3 bg-accent-strong sm:size-4" aria-hidden="true"></span>
                @endforeach
            @endforeach
        </div>
    </section>

    {{-- Business overview --}}
    <section class="section bg-paper">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Our business"
                title="Four connected areas of activity"
                lead="Our registered activities span the movement of petroleum products into, through and out of Albania, supported by our business locations."
            />

            <ul class="mt-16 grid gap-5 sm:grid-cols-2 lg:mt-20 lg:grid-cols-4" data-stagger>
                @foreach ($business as $item)
                    <li>
                        <a href="{{ route($item['route']) }}" class="group block">
                            <div class="img-frame img-zoom aspect-[3/4]">
                                <x-img :key="$item['image']" sizes="(min-width: 1024px) 25vw, (min-width: 640px) 50vw, 100vw" alt="" />
                                <div class="absolute inset-0 bg-gradient-to-t from-ink/85 via-ink/10 to-transparent"></div>
                                <span class="index-num absolute top-5 left-5 text-white/80">0{{ $loop->iteration }}</span>
                                <span class="absolute top-4 right-4 grid size-10 place-items-center bg-accent text-ink opacity-0 transition-all duration-500 ease-out-expo group-hover:opacity-100 group-focus-visible:opacity-100" aria-hidden="true">
                                    <x-icon name="arrow-up-right" class="size-4" />
                                </span>
                                <div class="absolute inset-x-5 bottom-5 text-white">
                                    <h3 class="font-display text-2xl font-semibold tracking-[-0.03em]">{{ $item['label'] }}</h3>
                                    <p class="mt-2 text-sm text-white/70">{{ $item['text'] }}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Products & services --}}
    <section class="on-dark section bg-ink text-white">
        <div class="container-site">
            <div class="grid gap-16 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <div class="lg:sticky lg:top-32">
                        <p class="eyebrow text-white/70" data-reveal>Products &amp; services</p>
                        <h2 class="text-h2 mt-6" data-split>What we are registered to trade and process</h2>
                        <p class="lead mt-6" data-reveal>Our scope is defined by our registered object of activity and wholesale trading licence. Current product availability and specifications are confirmed directly with our commercial team.</p>
                        <div class="mt-10" data-reveal>
                            <x-buttons.primary :href="route('services')">View Products &amp; Services</x-buttons.primary>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-7">
                    <ul class="border-t border-white/12" data-stagger>
                        @foreach ($products as $product)
                            <li class="group grid grid-cols-[auto_1fr] items-start gap-6 border-b border-white/12 py-8 sm:grid-cols-[auto_1fr_auto] sm:py-10">
                                <span class="index-num pt-2 text-white/40">0{{ $loop->iteration }}</span>
                                <div>
                                    <h3 class="font-display text-[clamp(1.5rem,1.2rem+1.2vw,2.4rem)] font-semibold tracking-[-0.03em] transition-colors duration-500 group-hover:text-accent">{{ $product['title'] }}</h3>
                                    <p class="mt-2 max-w-md text-white/60">{{ $product['text'] }}</p>
                                </div>
                                <span class="hidden size-14 place-items-center bg-white/6 text-accent transition-colors duration-500 group-hover:bg-accent group-hover:text-ink sm:grid">
                                    <x-icon :name="$product['icon']" class="size-6" />
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Petroleum trading --}}
    <section class="section bg-paper">
        <div class="container-site">
            <x-sections.split image="tanker-red" ratio="aspect-[4/5] lg:aspect-[5/6]">
                <p class="eyebrow" data-reveal>Petroleum trading</p>
                <h2 class="text-h2 mt-6" data-split>Connecting supply with commercial demand</h2>
                <p class="lead mt-6" data-reveal>Wholesale trading of oil, gas and their by-products is at the core of our licensed activity, from import and export through to supply for commercial customers.</p>
                <ul class="mt-10 divide-y divide-line border-y border-line" data-stagger>
                    @foreach ([['ship', 'Import & export', 'Cross-border movement of hydrocarbons and petroleum products.'], ['warehouse', 'Wholesale supply', 'Supply to commercial and industrial customers.'], ['handshake', 'Commercial partnerships', 'Long-term relationships with suppliers and buyers.']] as [$icon, $title, $text])
                        <li class="flex gap-5 py-5">
                            <x-icon :name="$icon" class="mt-0.5 size-6 text-olive" />
                            <div>
                                <p class="font-semibold text-ink-2">{{ $title }}</p>
                                <p class="mt-1 text-stone">{{ $text }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-10" data-reveal>
                    <x-buttons.primary :href="route('trading')" variant="dark">Petroleum Trading</x-buttons.primary>
                </div>
            </x-sections.split>
        </div>
    </section>

    {{-- Infrastructure --}}
    <section class="section border-t border-line bg-cream">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Infrastructure & facilities"
                title="Registered across three Albanian locations"
                lead="Our headquarters in the capital is complemented by registered business locations in the Fier region and at the Porto Romano hydrocarbons terminal on the Adriatic coast."
            />

            <div class="mt-16 grid gap-5 lg:mt-20 lg:grid-cols-3" data-stagger>
                @foreach ($locations as $key => $location)
                    <article class="group flex flex-col bg-paper">
                        <div class="img-frame img-zoom aspect-[16/11]">
                            <x-img :key="$location['image']" sizes="(min-width: 1024px) 33vw, 100vw" />
                        </div>
                        <div class="flex flex-1 flex-col p-7 sm:p-8">
                            <p class="text-xs font-semibold tracking-[0.16em] text-olive uppercase">{{ $location['label'] }}</p>
                            <h3 class="mt-3 font-display text-2xl font-semibold tracking-[-0.03em]">{{ $location['city'] }}</h3>
                            <address class="mt-4 flex-1 text-sm leading-relaxed not-italic text-stone">
                                {!! implode('<br>', array_map('e', $location['lines'])) !!}
                            </address>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center" data-reveal>
                <x-buttons.primary :href="route('infrastructure')" variant="outline">Infrastructure &amp; Facilities</x-buttons.primary>
            </div>
        </div>
    </section>

    {{-- HSE --}}
    <section class="on-dark relative isolate overflow-hidden bg-ink text-white">
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div data-parallax="14" class="size-full">
                <x-img key="engineer-hardhat" sizes="100vw" alt="" />
            </div>
            <div class="overlay-side absolute inset-0"></div>
        </div>
        <div class="container-site section">
            <div class="max-w-2xl">
                <p class="eyebrow text-white/75" data-reveal>Health, safety &amp; environment</p>
                <h2 class="text-h2 mt-6" data-split>Safety is the condition for everything we do</h2>
                <p class="lead mt-6" data-reveal>Working with hydrocarbons demands discipline. We are committed to protecting our people, our partners, neighbouring communities and the environment, and to operating within the permits that govern our activity.</p>
            </div>
            <div class="mt-14 grid gap-px bg-white/10 sm:grid-cols-3" data-stagger>
                @foreach ([['hard-hat', 'People', 'Competent, trained teams with the authority to stop unsafe work.'], ['shield-check', 'Operations', 'Planned, controlled handling of petroleum products.'], ['leaf', 'Environment', 'Prevention of spills and responsible management of waste.']] as [$icon, $title, $text])
                    <div class="bg-ink/70 p-7 backdrop-blur-sm sm:p-8">
                        <x-icon :name="$icon" class="size-7 text-accent" />
                        <h3 class="mt-6 font-display text-xl font-semibold tracking-[-0.02em]">{{ $title }}</h3>
                        <p class="mt-2 text-white/65">{{ $text }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-12 flex flex-wrap gap-3" data-reveal>
                <x-buttons.primary :href="route('hse')">Our HSE Commitment</x-buttons.primary>
                <x-buttons.primary :href="route('sustainability')" variant="ghost">Sustainability</x-buttons.primary>
            </div>
        </div>
    </section>

    {{-- Corporate values --}}
    <section class="section bg-paper">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Corporate values"
                title="The principles behind every agreement"
                lead="Our values guide how we trade, how we work with partners and how we take responsibility for our impact."
            />
            <x-sections.feature-list :items="$values" class="mt-16 lg:mt-20" />
        </div>
    </section>

    {{-- Latest news --}}
    @if ($latest->isNotEmpty())
        <section class="section border-t border-line bg-cream">
            <div class="container-site">
                <div class="flex flex-wrap items-end justify-between gap-8">
                    <x-sections.heading eyebrow="News & insights" title="Latest from AL.GLOBAL OIL" />
                    <div data-reveal>
                        <x-buttons.primary :href="route('news.index')" variant="outline">All News</x-buttons.primary>
                    </div>
                </div>
                <div class="mt-14 grid gap-x-5 gap-y-12 md:grid-cols-3" data-stagger>
                    @foreach ($latest as $article)
                        <x-news-card :article="$article" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-sections.cta
        eyebrow="Partner with us"
        title="Let’s build a reliable energy partnership"
        text="Whether you are a commercial buyer, a supplier or a potential partner, our team is ready to discuss your requirements."
        image="refinery-dusk"
        :primary="['label' => 'Start a Business Inquiry', 'route' => 'inquiry']"
        :secondary="['label' => 'Contact Our Team', 'route' => 'contact']"
    />

</x-layouts.app>
