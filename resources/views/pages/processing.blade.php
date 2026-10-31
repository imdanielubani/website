<x-layouts.app
    title="Refining & Processing"
    description="Petroleum processing at AL.GLOBAL OIL SH.A: our registered activity covering the processing of crude oil and its by-products, and how we approach industrial operations."
    image="refinery-night"
    :breadcrumbs="[['name' => 'Business'], ['name' => 'Refining & Processing']]"
>
    <x-sections.page-hero
        eyebrow="Refining & Processing"
        title="Processing crude oil and its by-products"
        lead="Since 2018, the processing of crude oil and its derivatives has formed part of our registered object of activity."
        image="refinery-night"
        :breadcrumbs="[['name' => 'Business'], ['name' => 'Refining & Processing']]"
    />

    {{-- Registered vs confirmed --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <p class="eyebrow" data-reveal>Petroleum processing</p>
                    <h2 class="text-h2 mt-6" data-split>A registered activity, described with care</h2>
                    <p class="lead mt-6" data-reveal>We distinguish clearly between what the company is registered to do and operational details that have been confirmed for publication.</p>
                </div>
                <div class="grid gap-5 lg:col-span-7" data-stagger>
                    <div class="border border-line bg-cream p-8 sm:p-10">
                        <div class="flex items-center gap-3">
                            <x-icon name="badge-check" class="size-6 text-olive" />
                            <p class="text-sm font-semibold tracking-[0.14em] text-olive uppercase">Registered activity</p>
                        </div>
                        <p class="mt-5 text-lg leading-relaxed text-ink-2">
                            “Processing of crude oil and its by-products”, added to the company’s object of activity on 31 January 2018, alongside wholesale import and export of hydrocarbons, fuels, oil, gas and their by-products.
                        </p>
                        <p class="mt-4 text-sm text-stone">Source: Albanian business register (QKB) extract.</p>
                    </div>
                    <div class="border border-dashed border-olive/40 p-8 sm:p-10">
                        <div class="flex items-center gap-3">
                            <x-icon name="clipboard-check" class="size-6 text-olive" />
                            <p class="text-sm font-semibold tracking-[0.14em] text-olive uppercase">Operational capabilities</p>
                        </div>
                        <p class="mt-5 leading-relaxed text-stone">
                            Information on facilities, processing units, operating status, capacity and output will be published here once confirmed by the company. Until then, please contact our technical team directly.
                        </p>
                        <div class="mt-6"><x-confirm /></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Crude oil & derivatives --}}
    <section class="on-dark section bg-ink text-white">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Crude oil & petroleum derivatives"
                title="From crude oil to usable products"
                lead="Processing transforms crude oil into products and intermediates for further use. The categories below describe the general scope of petroleum processing, not a confirmed product slate."
                class="[&_.lead]:text-white/70"
            />
            <x-sections.feature-list tone="dark" class="mt-16 lg:mt-20" :items="[
                ['icon' => 'droplet', 'title' => 'Crude oil', 'text' => 'The feedstock for petroleum processing, received, stored and handled under controlled conditions.'],
                ['icon' => 'layers', 'title' => 'Fractions & intermediates', 'text' => 'Separation of crude oil into fractions that can be treated or blended further.'],
                ['icon' => 'flame', 'title' => 'Fuels & derivatives', 'text' => 'Petroleum products and by-products within the company’s registered scope.'],
            ]" />
        </div>
    </section>

    {{-- Industrial operations --}}
    <section class="section bg-paper">
        <div class="container-site">
            <x-sections.split image="industrial-steam" ratio="aspect-[4/3] lg:aspect-[5/4]">
                <p class="eyebrow" data-reveal>Industrial operations</p>
                <h2 class="text-h2 mt-6" data-split>Operating principles for industrial work</h2>
                <p class="lead mt-6" data-reveal>Any industrial activity we undertake is governed by the same principles: planning, competence, control and environmental care.</p>
                <ul class="mt-10 divide-y divide-line border-y border-line" data-stagger>
                    @foreach ([
                        ['shield-check', 'Process safety', 'Hazards identified and controlled before work begins.'],
                        ['wrench', 'Maintenance & integrity', 'Equipment kept fit for purpose through planned maintenance.'],
                        ['leaf', 'Environmental controls', 'Measures to prevent spills, emissions and contamination.'],
                        ['users', 'Competent people', 'Trained personnel with clear responsibilities.'],
                    ] as [$icon, $title, $text])
                        <li class="flex gap-5 py-5">
                            <x-icon :name="$icon" class="mt-0.5 size-6 text-olive" />
                            <div>
                                <p class="font-semibold text-ink-2">{{ $title }}</p>
                                <p class="mt-1 text-stone">{{ $text }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </x-sections.split>
        </div>
    </section>

    {{-- Processing capabilities --}}
    <section class="section border-t border-line bg-cream">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Processing capabilities"
                title="Capability information"
                lead="This section is structured to present verified technical information. Fields remain marked until the company confirms the details."
            />
            <dl class="mt-16 grid gap-px border border-line bg-line sm:grid-cols-2 lg:mt-20 lg:grid-cols-4" data-stagger>
                @foreach (['Facility', 'Operating status', 'Processing capacity', 'Product slate'] as $field)
                    <div class="bg-paper p-7 sm:p-8">
                        <dt class="text-sm font-semibold tracking-[0.14em] text-stone uppercase">{{ $field }}</dt>
                        <dd class="mt-6"><x-confirm>To be confirmed</x-confirm></dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    <x-sections.cta
        eyebrow="Technical inquiry"
        title="Speak with us about processing"
        text="For technical questions about processing, feedstock or petroleum derivatives, contact our team directly."
        image="pipes-building"
        :primary="['label' => 'Submit a Technical Inquiry', 'route' => 'inquiry']"
        :secondary="['label' => 'Contact Our Team', 'route' => 'contact']"
    />
</x-layouts.app>
