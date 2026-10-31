<x-layouts.app
    title="Petroleum Trading"
    description="Petroleum trading in Albania: wholesale import and export of hydrocarbons, fuels, oil, gas and by-products by AL.GLOBAL OIL SH.A, a licensed wholesale trader."
    image="tanker-red"
    :breadcrumbs="[['name' => 'Business'], ['name' => 'Petroleum Trading']]"
>
    <x-sections.page-hero
        eyebrow="Petroleum Trading"
        title="Moving energy across borders, reliably"
        lead="Wholesale trading of oil, gas and their by-products is the core of our licensed activity."
        image="tanker-red"
        :breadcrumbs="[['name' => 'Business'], ['name' => 'Petroleum Trading']]"
    />

    {{-- Introduction --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <p class="eyebrow lg:col-span-3" data-reveal>{{ __('Introduction') }}</p>
                <div class="lg:col-span-9">
                    <p class="font-display text-[clamp(1.6rem,1.1rem+2vw,3rem)] leading-[1.18] font-medium tracking-[-0.03em]" data-split>
                        {{ __('Trading petroleum products well is about more than price. It depends on planning, documentation, compliance and trust between counterparties.') }}
                    </p>
                    <div class="mt-14 grid gap-10 border-t border-line pt-10 md:grid-cols-2">
                        <div data-reveal>
                            <p class="text-sm font-semibold tracking-[0.14em] text-olive uppercase">{{ __('Licence') }}</p>
                            <p class="mt-3 leading-relaxed text-stone">
                                {!! __('The public business register lists licence :code for AL.GLOBAL OIL, covering the wholesale trade of oil, gas and by-products, including bio-products and fuels.', ['code' => '<strong class="text-ink-2">VIII.1.A</strong>']) !!}
                            </p>
                        </div>
                        <div data-reveal data-delay="0.1">
                            <p class="text-sm font-semibold tracking-[0.14em] text-olive uppercase">{{ __('Scope') }}</p>
                            <p class="mt-3 leading-relaxed text-stone">
                                {{ __('Our registered object of activity covers import and export of hydrocarbons of all kinds, fuels, oil, gas and their by-products on a wholesale basis.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Import & export --}}
    <section class="on-dark relative isolate overflow-hidden bg-ink text-white">
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div data-parallax="14" class="size-full">
                <x-img key="ships-cloud" sizes="100vw" alt="" />
            </div>
            <div class="overlay-side absolute inset-0"></div>
        </div>
        <div class="container-site section">
            <div class="max-w-2xl">
                <p class="eyebrow text-white/75" data-reveal>{{ __('Import & export') }}</p>
                <h2 class="text-h2 mt-6" data-split>{{ __('From the Adriatic to commercial customers') }}</h2>
                <p class="lead mt-6" data-reveal>{{ __('Our registered business location at the Porto Romano hydrocarbons terminal in Durrës places us on Albania’s Adriatic coast, where seaborne cargoes meet inland distribution.') }}</p>
            </div>
            <ol class="mt-16 grid gap-px bg-white/10 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                @foreach ([
                    ['ship', 'Sourcing', 'Procurement of petroleum products from suppliers and partners.'],
                    ['file-text', 'Documentation', 'Quality, customs and commercial documents prepared accurately.'],
                    ['warehouse', 'Reception', 'Receipt and handling of product in line with applicable rules.'],
                    ['truck', 'Distribution', 'Onward supply to wholesale customers as agreed.'],
                ] as $i => [$icon, $title, $text])
                    <li class="bg-ink/75 p-7 backdrop-blur-sm sm:p-8">
                        <div class="flex items-center justify-between">
                            <x-icon :name="$icon" class="size-7 text-accent" />
                            <span class="index-num text-white/40">0{{ $i + 1 }}</span>
                        </div>
                        <h3 class="mt-10 font-display text-xl font-semibold tracking-[-0.02em]">{{ t($title) }}</h3>
                        <p class="mt-2 text-white/65">{{ t($text) }}</p>
                    </li>
                @endforeach
            </ol>
            <p class="mt-6 text-sm text-white/50" data-reveal>{{ __('Illustrative trading process. Specific routes, volumes and counterparties are agreed per contract.') }}</p>
        </div>
    </section>

    {{-- Wholesale trading --}}
    <section class="section bg-paper">
        <div class="container-site">
            <x-sections.split image="truck-station" ratio="aspect-[4/3] lg:aspect-[5/4]">
                <p class="eyebrow" data-reveal>{{ __('Wholesale trading') }}</p>
                <h2 class="text-h2 mt-6" data-split>{{ __('Supply arrangements for commercial buyers') }}</h2>
                <p class="lead mt-6" data-reveal>{{ __('We supply petroleum products on a wholesale basis to businesses that depend on reliable energy, under clear commercial terms.') }}</p>
                <dl class="mt-10 grid gap-px bg-line sm:grid-cols-2" data-stagger>
                    @foreach ([
                        'Customers' => 'Commercial and industrial buyers, distributors and resellers',
                        'Terms' => 'Volumes, pricing basis and delivery set out in contract',
                        'Documentation' => 'Product and quality documents with each supply',
                        'Contact' => 'A dedicated commercial point of contact',
                    ] as $label => $value)
                        <div class="bg-paper py-5 sm:pr-6">
                            <dt class="text-sm font-semibold text-ink-2">{{ t($label) }}</dt>
                            <dd class="mt-1 text-stone">{{ t($value) }}</dd>
                        </div>
                    @endforeach
                </dl>
            </x-sections.split>
        </div>
    </section>

    {{-- Commercial partnerships --}}
    <section class="section border-t border-line bg-cream">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Commercial partnerships"
                title="Partnerships that last beyond a single cargo"
                lead="We seek suppliers, customers and service providers who share our commitment to reliability, safety and compliance."
            />
            <x-sections.feature-list class="mt-16 lg:mt-20" :items="[
                ['icon' => 'handshake', 'title' => 'Suppliers', 'text' => 'Producers and traders seeking a dependable counterparty for the Albanian market.'],
                ['icon' => 'building-2', 'title' => 'Customers', 'text' => 'Businesses requiring wholesale supply of fuels and petroleum products.'],
                ['icon' => 'route', 'title' => 'Logistics partners', 'text' => 'Shipping, storage and transport providers supporting safe product movement.'],
            ]" />
        </div>
    </section>

    {{-- Business approach --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <p class="eyebrow" data-reveal>{{ __('Business approach') }}</p>
                    <h2 class="text-h2 mt-6" data-split>{{ __('Principles we trade by') }}</h2>
                </div>
                <ul class="divide-y divide-line border-y border-line lg:col-span-7" data-stagger>
                    @foreach ([
                        ['Compliance', 'We trade within our licences and follow customs, tax and sector regulations.'],
                        ['Transparency', 'Clear terms and honest communication, including when circumstances change.'],
                        ['Prudence', 'Measured decisions and careful counterparty selection.'],
                        ['Safety', 'Every movement of product is planned with safety in mind.'],
                    ] as [$title, $text])
                        <li class="grid gap-2 py-7 sm:grid-cols-[12rem_1fr] sm:gap-8">
                            <h3 class="font-display text-xl font-semibold tracking-[-0.02em]">{{ t($title) }}</h3>
                            <p class="leading-relaxed text-stone">{{ t($text) }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <x-sections.cta
        eyebrow="Trading inquiry"
        title="Discuss a trading opportunity"
        text="Buyers, suppliers and logistics partners are welcome to contact our commercial team."
        image="tanker-sea"
        :primary="['label' => 'Submit a Trading Inquiry', 'route' => 'inquiry']"
        :secondary="['label' => 'Contact Our Team', 'route' => 'contact']"
    />
</x-layouts.app>
