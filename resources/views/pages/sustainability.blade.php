<x-layouts.app
    title="Sustainability"
    description="How AL.GLOBAL OIL SH.A approaches sustainability: responsible operations, environmental awareness, long-term partnerships and continuous improvement."
    image="tank-water"
    :breadcrumbs="[['name' => 'Responsibility'], ['name' => 'Sustainability']]"
>
    <x-sections.page-hero
        eyebrow="Sustainability"
        title="Responsible today, ready for tomorrow"
        lead="For an energy company, sustainability starts with how we operate every day: safely, efficiently and with respect for the communities and environment around us."
        image="tank-water"
        :breadcrumbs="[['name' => 'Responsibility'], ['name' => 'Sustainability']]"
    />

    {{-- Introduction --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <p class="eyebrow lg:col-span-3" data-reveal>{{ __('Introduction') }}</p>
                <div class="lg:col-span-9">
                    <p class="font-display text-[clamp(1.6rem,1.1rem+2vw,3rem)] leading-[1.18] font-medium tracking-[-0.03em]" data-split>
                        {{ __('We believe a credible approach to sustainability is built on honest, practical actions rather than broad promises.') }}
                    </p>
                    <p class="mt-10 max-w-2xl leading-relaxed text-stone" data-reveal>
                        {{ __('This page sets out the principles that guide us. Where we publish targets or performance data in future, they will be measured, verified and reported transparently.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Editorial pillars --}}
    @foreach ([
        ['eyebrow' => 'Responsible operations', 'title' => 'Doing the fundamentals well', 'text' => 'Safe handling of products, well-maintained equipment and careful planning reduce waste, prevent incidents and protect the environment. Responsible operations are the foundation for everything else.', 'image' => 'pipes-rust'],
        ['eyebrow' => 'Environmental awareness', 'title' => 'Understanding our footprint', 'text' => 'We recognise the environmental impact of the petroleum sector. We operate within our environmental permits, focus on preventing spills and pollution, and encourage awareness among our people and partners.', 'image' => 'tanks-sunrise'],
        ['eyebrow' => 'Long-term partnerships', 'title' => 'Value that lasts', 'text' => 'Stable, long-term relationships with customers, suppliers and communities create more value than short-term transactions. We aim to be a dependable partner and a responsible member of the Albanian business community.', 'image' => 'meeting-room'],
    ] as $pillar)
        <section class="pb-20 sm:pb-28 lg:pb-36 bg-paper">
            <div class="container-site">
                <x-sections.split :image="$pillar['image']" :reverse="$loop->even" ratio="aspect-[4/3] lg:aspect-[5/4]">
                    <p class="eyebrow" data-reveal>{{ t($pillar['eyebrow']) }}</p>
                    <h2 class="text-h2 mt-6" data-split>{{ t($pillar['title']) }}</h2>
                    <p class="lead mt-6" data-reveal>{{ t($pillar['text']) }}</p>
                </x-sections.split>
            </div>
        </section>
    @endforeach

    {{-- Continuous improvement --}}
    <section class="on-dark section bg-ink text-white">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Continuous improvement"
                title="Learning, measuring and improving"
                lead="Improvement is a cycle. We review how we work, learn from experience and adjust."
            />
            <ol class="mt-16 grid gap-px border border-white/10 bg-white/10 sm:grid-cols-2 lg:mt-20 lg:grid-cols-4" data-stagger>
                @foreach ([
                    ['Plan', 'Set clear objectives and identify risks and opportunities.'],
                    ['Do', 'Put controls and good practices into everyday work.'],
                    ['Check', 'Review results, incidents and feedback honestly.'],
                    ['Improve', 'Act on lessons learned and raise the standard.'],
                ] as $i => [$title, $text])
                    <li class="bg-ink p-7 sm:p-8">
                        <span class="index-num text-accent">0{{ $i + 1 }}</span>
                        <h3 class="mt-10 font-display text-2xl font-semibold tracking-[-0.03em]">{{ t($title) }}</h3>
                        <p class="mt-2 text-white/60">{{ t($text) }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Future commitments --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <p class="eyebrow" data-reveal>{{ __('Future commitments') }}</p>
                    <h2 class="text-h2 mt-6" data-split>{{ __('What we commit to') }}</h2>
                    <p class="lead mt-6" data-reveal>{{ __('Our commitments are deliberately practical. Any quantified targets will be published only once they are defined and can be measured.') }}</p>
                </div>
                <ul class="divide-y divide-line border-y border-line lg:col-span-7" data-stagger>
                    @foreach ([
                        ['shield-check', 'Keep safety and environmental protection at the centre of our operations.'],
                        ['badge-check', 'Maintain compliance with all permits, licences and regulations that apply to us.'],
                        ['sprout', 'Encourage responsible practices among our partners and contractors.'],
                        ['file-text', 'Report transparently on our progress when performance data is available.'],
                    ] as [$icon, $text])
                        <li class="flex gap-5 py-6">
                            <x-icon :name="$icon" class="mt-0.5 size-6 text-olive" />
                            <p class="text-lg text-ink-2">{{ t($text) }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <x-sections.cta
        eyebrow="Responsibility"
        title="Health, safety and the environment"
        text="Read about the HSE principles, permits and commitments that guide our operations."
        image="engineer-hardhat"
        :primary="['label' => 'Our HSE Commitment', 'route' => 'hse']"
        :secondary="['label' => 'Contact Our Team', 'route' => 'contact']"
    />
</x-layouts.app>
