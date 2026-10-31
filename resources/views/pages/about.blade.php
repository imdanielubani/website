@php
    $milestones = [
        ['date' => '11 Oct 2016', 'title' => 'Company founded', 'text' => 'AL.GLOBAL OIL is established in Tirana as a joint-stock company (SH.A).', 'verified' => true],
        ['date' => '14 Oct 2016', 'title' => 'Entered in the business register', 'text' => 'Registered with the National Business Centre under NUIS ' . config('company.nuis') . '.', 'verified' => true],
        ['date' => '31 Jan 2018', 'title' => 'Scope extended to processing', 'text' => 'The registered object of activity is extended to include the processing of crude oil and its by-products.', 'verified' => true],
        ['date' => 'Today', 'title' => 'Three registered locations', 'text' => 'Headquarters in Tirana with registered business locations in Fier and at Porto Romano, Durrës.', 'verified' => true],
    ];

    $values = [
        ['icon' => 'shield-check', 'title' => 'Safety first', 'text' => 'No commercial objective outranks the safety of people and the protection of the environment.'],
        ['icon' => 'scale', 'title' => 'Integrity', 'text' => 'We act honestly, keep our word and respect the law in every market we serve.'],
        ['icon' => 'handshake', 'title' => 'Partnership', 'text' => 'We build relationships for the long term, based on fairness and mutual benefit.'],
        ['icon' => 'badge-check', 'title' => 'Compliance', 'text' => 'We operate within our licences and permits and meet our regulatory obligations.'],
        ['icon' => 'gauge', 'title' => 'Reliability', 'text' => 'We plan carefully and follow through, so partners can depend on our commitments.'],
        ['icon' => 'leaf', 'title' => 'Responsibility', 'text' => 'We take ownership of our impact on communities and the environment.'],
    ];
@endphp

<x-layouts.app
    title="About Us"
    description="About AL.GLOBAL OIL SH.A: an Albanian petroleum and hydrocarbons company established in Tirana in 2016. Our history, mission, vision, values and partnership approach."
    image="office-glass"
    :breadcrumbs="[['name' => 'About Us']]"
>
    <x-sections.page-hero
        eyebrow="About Us"
        title="An Albanian energy company built on trust"
        lead="Established in Tirana in 2016, AL.GLOBAL OIL SH.A operates in the trade and processing of hydrocarbons, fuels, gas and their by-products."
        image="office-glass"
        :breadcrumbs="[['name' => 'About Us']]"
    />

    {{-- Introduction --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <p class="eyebrow lg:col-span-3" data-reveal>Company introduction</p>
                <div class="lg:col-span-9">
                    <p class="font-display text-[clamp(1.6rem,1.1rem+2vw,3rem)] leading-[1.18] font-medium tracking-[-0.03em]" data-split>
                        We exist to supply the energy that keeps businesses moving, with the discipline, transparency and reliability that long-term partners expect.
                    </p>
                    <div class="mt-14 grid gap-10 border-t border-line pt-10 md:grid-cols-2">
                        <p class="leading-relaxed text-stone" data-reveal>
                            AL.GLOBAL OIL SH.A is a joint-stock company registered in Albania. Our registered object of activity covers the wholesale import and export of hydrocarbons of all kinds, fuels, oil, gas and their by-products, as well as the processing of crude oil and its derivatives.
                        </p>
                        <p class="leading-relaxed text-stone" data-reveal data-delay="0.1">
                            From our headquarters in Tirana and our registered business locations in Fier and at the Porto Romano hydrocarbons terminal in Durrës, we work with commercial customers, suppliers and partners across the petroleum value chain.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- History --}}
    <section class="section border-t border-line bg-cream">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Company history"
                title="Milestones from the public register"
                lead="The key dates below are drawn from AL.GLOBAL OIL’s entry in the Albanian business register."
            />
            <ol class="mt-16 grid gap-px bg-line lg:mt-20 lg:grid-cols-4" data-stagger>
                @foreach ($milestones as $milestone)
                    <li class="relative bg-cream p-8 pt-10">
                        <span class="absolute top-0 left-8 h-1 w-10 bg-accent-strong" aria-hidden="true"></span>
                        <p class="font-display text-2xl font-semibold tracking-[-0.03em]">{{ $milestone['date'] }}</p>
                        <h3 class="mt-6 font-semibold">{{ $milestone['title'] }}</h3>
                        <p class="mt-2 leading-relaxed text-stone">{{ $milestone['text'] }}</p>
                    </li>
                @endforeach
            </ol>
            <div class="mt-8" data-reveal>
                <x-confirm>Further milestones (projects, partnerships, facilities) to be added once confirmed by the company</x-confirm>
            </div>
        </div>
    </section>

    {{-- Corporate background --}}
    <section class="section bg-paper">
        <div class="container-site">
            <x-sections.split image="refinery-dusk" ratio="aspect-[4/5]">
                <p class="eyebrow" data-reveal>Corporate background</p>
                <h2 class="text-h2 mt-6" data-split>Registered for the full petroleum value chain</h2>
                <p class="lead mt-6" data-reveal>Our registration combines trading, import and export with processing, giving us the scope to serve partners at several points between supply and end use.</p>
                <dl class="mt-10 divide-y divide-line border-y border-line" data-stagger>
                    @foreach ([
                        'Registered name' => config('company.name'),
                        'Legal form' => config('company.legal_form'),
                        'NUIS' => config('company.nuis'),
                        'Founded' => \Illuminate\Support\Carbon::parse(config('company.founded'))->format('j F Y'),
                        'Registered seat' => 'Tirana, Albania',
                        'Other locations' => 'Fier · Porto Romano, Durrës',
                    ] as $label => $value)
                        <div class="grid grid-cols-[9rem_1fr] gap-4 py-4 sm:grid-cols-[12rem_1fr]">
                            <dt class="text-stone">{{ $label }}</dt>
                            <dd class="font-medium text-ink-2">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </x-sections.split>
        </div>
    </section>

    {{-- Mission & vision --}}
    <section class="on-dark section bg-ink text-white">
        <div class="container-site">
            <div class="grid gap-px bg-white/10 lg:grid-cols-2">
                <div class="bg-ink p-8 sm:p-12 lg:p-16" data-reveal>
                    <span class="grid size-14 place-items-center bg-accent text-ink"><x-icon name="target" class="size-6" /></span>
                    <p class="eyebrow mt-10 text-white/60">Mission</p>
                    <p class="mt-5 font-display text-[clamp(1.5rem,1.2rem+1.2vw,2.4rem)] leading-tight font-medium tracking-[-0.03em]">
                        To supply petroleum products and hydrocarbons reliably and responsibly, creating lasting value for our customers, partners and Albania’s economy.
                    </p>
                </div>
                <div class="bg-ink p-8 sm:p-12 lg:p-16" data-reveal data-delay="0.1">
                    <span class="grid size-14 place-items-center bg-white/8 text-accent"><x-icon name="compass" class="size-6" /></span>
                    <p class="eyebrow mt-10 text-white/60">Vision</p>
                    <p class="mt-5 font-display text-[clamp(1.5rem,1.2rem+1.2vw,2.4rem)] leading-tight font-medium tracking-[-0.03em]">
                        To be recognised as a trusted Albanian energy partner, known for integrity, safety and dependable service across the region.
                    </p>
                </div>
            </div>
            <div class="mt-8" data-reveal>
                <x-confirm>Draft mission and vision wording for approval by the company</x-confirm>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="section bg-paper">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Core values"
                title="What we stand for"
                lead="Six principles shape our decisions, from the contracts we sign to the way we handle every litre of product."
            />
            <x-sections.feature-list :items="$values" class="mt-16 lg:mt-20" />
        </div>
    </section>

    {{-- Business philosophy --}}
    <section class="relative overflow-hidden bg-cream">
        <div class="grid lg:grid-cols-2">
            <div class="img-frame aspect-[4/3] lg:aspect-auto lg:min-h-[44rem]" data-reveal="clip">
                <div data-parallax="10" class="size-full">
                    <x-img key="pipes-tanks" sizes="(min-width: 1024px) 50vw, 100vw" />
                </div>
            </div>
            <div class="flex items-center px-5 py-20 sm:px-12 lg:px-20 lg:py-28">
                <div class="max-w-xl">
                    <p class="eyebrow" data-reveal>Business philosophy</p>
                    <h2 class="text-h2 mt-6" data-split>Steady, disciplined and built for the long term</h2>
                    <div class="mt-8 space-y-5 leading-relaxed text-stone" data-reveal>
                        <p>Energy markets reward patience and punish shortcuts. We favour careful planning over speculation, durable relationships over one-off transactions, and full compliance over convenience.</p>
                        <p>That philosophy shapes how we evaluate opportunities, how we negotiate, and how we deliver on what we agree.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Corporate structure --}}
    <section class="section bg-paper">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Corporate structure"
                title="Governed as an Albanian joint-stock company"
                lead="As a Shoqëri Aksionare, AL.GLOBAL OIL is governed by its shareholders’ assembly, a supervisory board and an appointed administrator, in line with Albanian company law."
            />
            <div class="mt-16 grid gap-5 md:grid-cols-3 lg:mt-20" data-stagger>
                @foreach ([
                    ['landmark', 'General Assembly', 'Shareholders take the company’s principal decisions, including capital and statutory matters.'],
                    ['users', 'Supervisory Board', 'Oversees management and the company’s strategic direction on behalf of shareholders.'],
                    ['briefcase', 'Administration', 'The administrator leads day-to-day management and represents the company.'],
                ] as [$icon, $title, $text])
                    <div class="border border-line p-8 sm:p-10">
                        <x-icon :name="$icon" class="size-7 text-olive" />
                        <h3 class="mt-8 font-display text-xl font-semibold tracking-[-0.02em]">{{ $title }}</h3>
                        <p class="mt-3 leading-relaxed text-stone">{{ $text }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-8" data-reveal>
                <x-confirm>Leadership profiles and organisational chart to be supplied by the company</x-confirm>
            </div>
        </div>
    </section>

    {{-- Partnership approach --}}
    <section class="on-dark section bg-ink-2 text-white">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <p class="eyebrow text-white/70" data-reveal>Partnership approach</p>
                    <h2 class="text-h2 mt-6" data-split>How we work with partners</h2>
                    <p class="lead mt-6" data-reveal>Every relationship starts with understanding what our partner needs, and continues with consistent, transparent delivery.</p>
                </div>
                <ol class="space-y-0 border-t border-white/12 lg:col-span-7" data-stagger>
                    @foreach ([
                        ['Listen', 'We start by understanding your requirements, volumes, timelines and constraints.'],
                        ['Agree', 'We set out clear commercial terms, responsibilities and documentation.'],
                        ['Deliver', 'We execute safely and in full compliance, communicating proactively.'],
                        ['Review', 'We review performance together and look for ways to improve.'],
                    ] as $i => [$title, $text])
                        <li class="grid grid-cols-[3.5rem_1fr] gap-4 border-b border-white/12 py-8">
                            <span class="index-num pt-1.5 text-accent">0{{ $i + 1 }}</span>
                            <div>
                                <h3 class="font-display text-2xl font-semibold tracking-[-0.03em]">{{ $title }}</h3>
                                <p class="mt-2 text-white/60">{{ $text }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>

    <x-sections.cta
        eyebrow="Get in touch"
        title="Discuss your energy requirements with our team"
        text="Contact us to explore how AL.GLOBAL OIL can support your business."
        image="tanks-field"
    />
</x-layouts.app>
