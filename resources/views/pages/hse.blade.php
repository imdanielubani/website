<x-layouts.app
    title="Health, Safety & Environment"
    description="The health, safety and environmental principles of AL.GLOBAL OIL SH.A: protecting people, operating responsibly and complying with the permits that govern our activity."
    image="engineer-hardhat"
    :breadcrumbs="[['name' => 'Responsibility'], ['name' => 'Health, Safety & Environment']]"
>
    <x-sections.page-hero
        eyebrow="Health, Safety & Environment"
        title="Everyone goes home safe"
        lead="Handling hydrocarbons carries real risk. Our HSE principles exist so that people, communities and the environment are protected in everything we do."
        image="engineer-hardhat"
        :breadcrumbs="[['name' => 'Responsibility'], ['name' => 'HSE']]"
    />

    {{-- Introduction --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <p class="eyebrow lg:col-span-3" data-reveal>{{ __('Our approach') }}</p>
                <div class="lg:col-span-9">
                    <p class="font-display text-[clamp(1.6rem,1.1rem+2vw,3rem)] leading-[1.18] font-medium tracking-[-0.03em]" data-split>
                        {{ __('Health, safety and environmental protection are not separate from our business. They are how our business is done.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Health and safety principles --}}
    <section class="section border-t border-line bg-cream">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Health & safety principles"
                title="Principles that guide every task"
                lead="These principles apply to employees, contractors and visitors at every location where we work."
            />
            <x-sections.feature-list class="mt-16 lg:mt-20" :cols="4" :items="[
                ['icon' => 'hard-hat', 'title' => 'Plan before work', 'text' => 'Hazards are identified and controls agreed before any task begins.'],
                ['icon' => 'users', 'title' => 'Competence', 'text' => 'People are trained and equipped for the work they carry out.'],
                ['icon' => 'life-buoy', 'title' => 'Stop work authority', 'text' => 'Anyone may stop a task they believe is unsafe, without consequence.'],
                ['icon' => 'heart-pulse', 'title' => 'Wellbeing', 'text' => 'Care for physical and mental health throughout the working day.'],
            ]" />
        </div>
    </section>

    {{-- Environmental responsibility --}}
    <section class="section bg-paper">
        <div class="container-site">
            <x-sections.split image="tanks-field" ratio="aspect-[4/3] lg:aspect-[5/4]">
                <p class="eyebrow" data-reveal>{{ __('Environmental responsibility') }}</p>
                <h2 class="text-h2 mt-6" data-split>{{ __('Preventing harm to land, water and air') }}</h2>
                <p class="lead mt-6" data-reveal>{{ __('Prevention is the most effective form of environmental protection. We focus on containing product, avoiding spills and managing waste responsibly.') }}</p>
                <ul class="mt-10 divide-y divide-line border-y border-line" data-stagger>
                    @foreach ([
                        ['droplet', 'Containment', 'Controls to prevent leaks and spills during storage and transfer.'],
                        ['recycle', 'Waste management', 'Responsible handling and disposal of waste through authorised channels.'],
                        ['waves', 'Spill readiness', 'Preparedness to respond quickly and effectively if an incident occurs.'],
                    ] as [$icon, $title, $text])
                        <li class="flex gap-5 py-5">
                            <x-icon :name="$icon" class="mt-0.5 size-6 text-olive" />
                            <div>
                                <p class="font-semibold text-ink-2">{{ t($title) }}</p>
                                <p class="mt-1 text-stone">{{ t($text) }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </x-sections.split>
        </div>
    </section>

    {{-- Operational responsibility --}}
    <section class="on-dark relative isolate overflow-hidden bg-ink text-white">
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div data-parallax="14" class="size-full">
                <x-img key="valves-red" sizes="100vw" alt="" />
            </div>
            <div class="overlay-side absolute inset-0"></div>
        </div>
        <div class="container-site section">
            <div class="max-w-2xl">
                <p class="eyebrow text-white/75" data-reveal>{{ __('Operational responsibility') }}</p>
                <h2 class="text-h2 mt-6" data-split>{{ __('Discipline in every operation') }}</h2>
                <p class="lead mt-6" data-reveal>{{ __('Safe operations depend on well-maintained equipment, clear procedures and people who follow them consistently, including our contractors and partners.') }}</p>
            </div>
            <ul class="mt-14 grid gap-px bg-white/10 sm:grid-cols-3" data-stagger>
                @foreach ([
                    ['wrench', 'Asset integrity', 'Equipment inspected and maintained to remain fit for purpose.'],
                    ['clipboard-check', 'Procedures', 'Documented ways of working for higher-risk activities.'],
                    ['handshake', 'Contractor management', 'Partners held to the same safety expectations as our own teams.'],
                ] as [$icon, $title, $text])
                    <li class="bg-ink/75 p-7 backdrop-blur-sm sm:p-8">
                        <x-icon :name="$icon" class="size-7 text-accent" />
                        <h3 class="mt-6 font-display text-xl font-semibold tracking-[-0.02em]">{{ t($title) }}</h3>
                        <p class="mt-2 text-white/65">{{ t($text) }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Regulatory compliance --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <p class="eyebrow" data-reveal>{{ __('Regulatory compliance') }}</p>
                    <h2 class="text-h2 mt-6" data-split>{{ __('Licences and permits') }}</h2>
                    <p class="lead mt-6" data-reveal>{{ __('The public Albanian business register lists the following licence and environmental permits for AL.GLOBAL OIL.') }}</p>
                    <p class="mt-6 text-sm text-stone" data-reveal>{{ __('Validity and scope should be confirmed with the company. Certificates and policies can be added below once supplied.') }}</p>
                </div>
                <div class="lg:col-span-7">
                    <ul class="border-t border-line" data-stagger>
                        @foreach (config('company.licences') as $licence)
                            <li class="grid grid-cols-[6.5rem_1fr] items-baseline gap-6 border-b border-line py-7">
                                <span class="font-display text-lg font-semibold tracking-[-0.02em] text-olive">{{ $licence['code'] }}</span>
                                <span class="text-lg text-ink-2">{{ t($licence['title']) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Policies and certifications: ready for company-supplied documents --}}
            <div class="mt-20 border border-dashed border-olive/40 bg-cream p-8 sm:p-12" data-reveal>
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl">
                        <h3 class="font-display text-2xl font-semibold tracking-[-0.02em]">{{ __('Policies & certifications') }}</h3>
                        <p class="mt-3 leading-relaxed text-stone">{{ __('This area is prepared for the company’s HSE policy, environmental policy and any certifications, published as downloadable documents once they are supplied and verified.') }}</p>
                    </div>
                    <x-confirm>{{ __('Documents to be supplied by the company') }}</x-confirm>
                </div>
                <ul class="mt-8 grid gap-4 sm:grid-cols-3">
                    @foreach (['HSE Policy', 'Environmental Policy', 'Certifications'] as $doc)
                        <li class="flex items-center gap-4 border border-line bg-paper p-5 text-stone">
                            <x-icon name="file-text" class="size-6 text-olive" />
                            <span><span class="block font-semibold text-ink-2">{{ t($doc) }}</span><span class="text-sm">{{ __('Pending') }}</span></span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- Commitment --}}
    <section class="on-dark section-tight bg-ink-2 text-white">
        <div class="container-site">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-center">
                <p class="eyebrow text-white/70 lg:col-span-3" data-reveal>{{ __('Our commitment') }}</p>
                <blockquote class="font-display text-[clamp(1.5rem,1.15rem+1.4vw,2.6rem)] leading-tight font-medium tracking-[-0.03em] lg:col-span-9" data-split>
                    {{ __('We commit to identify and control risks, comply with the law, prevent pollution, learn from every incident and near miss, and continually improve our HSE performance.') }}
                </blockquote>
            </div>
        </div>
    </section>

    <x-sections.cta
        eyebrow="Responsibility"
        title="Read about our long-term commitments"
        text="Discover how we think about responsible operations, partnerships and continuous improvement."
        image="tank-water"
        :primary="['label' => 'Sustainability', 'route' => 'sustainability']"
        :secondary="['label' => 'Contact Our Team', 'route' => 'contact']"
    />
</x-layouts.app>
