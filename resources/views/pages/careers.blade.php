@php
    $email = config('company.contact.email');
@endphp

<x-layouts.app
    title="Careers"
    description="Careers at AL.GLOBAL OIL SH.A in Albania. Discover working in the energy sector, our culture and how to submit your CV for future opportunities."
    image="engineer-hardhat"
    :breadcrumbs="[['name' => 'Careers']]"
>
    <x-sections.page-hero
        eyebrow="Careers"
        title="Build your career in energy"
        lead="We look for people who take safety seriously, value integrity and want to grow with an Albanian energy company."
        image="pipes-valves"
        :breadcrumbs="[['name' => 'Careers']]"
    />

    {{-- Introduction --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <p class="eyebrow lg:col-span-3" data-reveal>Careers at AL.GLOBAL OIL</p>
                <div class="lg:col-span-9">
                    <p class="font-display text-[clamp(1.6rem,1.1rem+2vw,3rem)] leading-[1.18] font-medium tracking-[-0.03em]" data-split>
                        The energy sector rewards people who are careful, curious and committed. If that sounds like you, we would like to hear from you.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Working in the energy sector --}}
    <section class="pb-20 sm:pb-28 lg:pb-36 bg-paper">
        <div class="container-site">
            <x-sections.split image="engineer-hardhat" ratio="aspect-[4/3] lg:aspect-[5/4]">
                <p class="eyebrow" data-reveal>Working in the energy sector</p>
                <h2 class="text-h2 mt-6" data-split>Meaningful work at the heart of the economy</h2>
                <p class="lead mt-6" data-reveal>Energy powers transport, industry and everyday life. Working in petroleum trading and operations means contributing to something essential, in an environment where standards matter.</p>
                <ul class="mt-10 grid gap-px bg-line sm:grid-cols-2" data-stagger>
                    @foreach ([
                        ['briefcase', 'Commercial & trading'],
                        ['hard-hat', 'Operations & HSE'],
                        ['truck', 'Logistics'],
                        ['landmark', 'Finance & administration'],
                    ] as [$icon, $area])
                        <li class="flex items-center gap-4 bg-paper py-5 sm:pr-6">
                            <x-icon :name="$icon" class="size-6 text-olive" />
                            <span class="font-medium text-ink-2">{{ $area }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="mt-4 text-sm text-stone" data-reveal>Typical areas of work in our sector.</p>
            </x-sections.split>
        </div>
    </section>

    {{-- Culture --}}
    <section class="on-dark section bg-ink text-white">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="Company culture"
                title="What it means to work with us"
                lead="Our culture is shaped by the same values we bring to our partners."
            />
            <x-sections.feature-list tone="dark" class="mt-16 lg:mt-20" :cols="4" :items="[
                ['icon' => 'shield-check', 'title' => 'Safety always', 'text' => 'Everyone has the right and the duty to work safely.'],
                ['icon' => 'scale', 'title' => 'Integrity', 'text' => 'We do the right thing, even when it is harder.'],
                ['icon' => 'users', 'title' => 'Teamwork', 'text' => 'Respect and collaboration across every function.'],
                ['icon' => 'trending-up', 'title' => 'Growth', 'text' => 'Opportunities to learn and take on responsibility.'],
            ]" />
        </div>
    </section>

    {{-- Opportunities --}}
    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <p class="eyebrow" data-reveal>Career opportunities</p>
                    <h2 class="text-h2 mt-6" data-split>Current openings</h2>
                    <p class="lead mt-6" data-reveal>Open positions are published here when available.</p>
                </div>
                <div class="lg:col-span-7">
                    <div class="border border-line bg-cream p-8 sm:p-12" data-reveal>
                        <x-icon name="briefcase" class="size-8 text-olive" />
                        <h3 class="mt-8 font-display text-2xl font-semibold tracking-[-0.03em]">No vacancies are advertised at the moment</h3>
                        <p class="mt-4 leading-relaxed text-stone">
                            We are always interested in hearing from talented people. Send us a general application and we will keep your details on file for future opportunities that match your experience.
                        </p>
                        <div class="mt-8">
                            <x-buttons.primary :href="route('contact', ['type' => 'careers']) . '#contact-form'" variant="dark">Send a General Application</x-buttons.primary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CV submission --}}
    <section class="section border-t border-line bg-cream">
        <div class="container-site">
            <x-sections.heading
                align="split"
                eyebrow="CV submission"
                title="How to apply"
                lead="Follow these steps for a general application. We review every submission carefully."
            />
            <ol class="mt-16 grid gap-px border border-line bg-line md:grid-cols-3 lg:mt-20" data-stagger>
                @foreach ([
                    ['Choose “Careers inquiry”', 'Open the contact form and select the Careers inquiry type.'],
                    ['Introduce yourself', 'Tell us about your experience, the area you are interested in and your availability.'],
                    ['Share your CV', $email ? 'Email your CV (PDF) to ' . $email . ', quoting your name in the subject line.' : 'Our team will reply with instructions for sending your CV securely.'],
                ] as $i => [$title, $text])
                    <li class="bg-paper p-8 sm:p-10">
                        <span class="index-num text-olive">Step 0{{ $i + 1 }}</span>
                        <h3 class="mt-8 font-display text-xl font-semibold tracking-[-0.02em]">{{ $title }}</h3>
                        <p class="mt-3 leading-relaxed text-stone">{{ $text }}</p>
                    </li>
                @endforeach
            </ol>
            <p class="mt-8 max-w-3xl text-sm leading-relaxed text-stone" data-reveal>
                We process applicant data only to assess your application, as described in our <a href="{{ route('legal.privacy') }}" class="font-medium text-ink-2 underline underline-offset-4">Privacy Policy</a>. Please do not send identity documents or sensitive personal information at this stage.
            </p>
        </div>
    </section>

    <x-sections.cta
        eyebrow="Careers inquiry"
        title="Interested in joining AL.GLOBAL OIL?"
        text="Get in touch with our team to introduce yourself."
        image="office-glass"
        :primary="['label' => 'Careers Inquiry', 'route' => 'contact']"
        :secondary="['label' => 'About the Company', 'route' => 'about']"
    />
</x-layouts.app>
