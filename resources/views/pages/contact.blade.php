@php
    $email = config('company.contact.email');
    $hq = config('company.locations.tirana');
@endphp

<x-layouts.app
    title="Contact Us"
    description="Contact AL.GLOBAL OIL SH.A in Tirana, Albania. Telephone, registered address and inquiry form for customers, suppliers, careers and general questions."
    image="office-evening"
    :breadcrumbs="[['name' => 'Contact']]"
>
    <x-sections.page-hero
        eyebrow="Contact Us"
        title="Let’s talk energy"
        lead="Reach our team in Tirana by phone or send us a message. Choose the inquiry type that fits and we will direct it to the right people."
        image="office-evening"
        size="md"
        :breadcrumbs="[['name' => 'Contact']]"
    />

    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-16 lg:grid-cols-12 lg:gap-20">

                {{-- Contact details --}}
                <aside class="lg:col-span-4">
                    <div class="lg:sticky lg:top-32">
                        <p class="eyebrow" data-reveal>Company</p>
                        <h2 class="mt-5 font-display text-3xl font-semibold tracking-[-0.03em]" data-reveal>{{ config('company.name') }}</h2>
                        <p class="mt-2 text-sm text-stone" data-reveal>NUIS {{ config('company.nuis') }}</p>

                        <dl class="mt-10 divide-y divide-line border-y border-line" data-stagger>
                            <div class="flex gap-4 py-6">
                                <x-icon name="map-pin" class="mt-0.5 size-5 text-olive" />
                                <div>
                                    <dt class="text-sm font-semibold text-ink-2">Registered headquarters</dt>
                                    <dd class="mt-2 leading-relaxed text-stone">
                                        <address class="not-italic">{!! implode('<br>', array_map('e', $hq['lines'])) !!}</address>
                                    </dd>
                                </div>
                            </div>
                            <div class="flex gap-4 py-6">
                                <x-icon name="phone" class="mt-0.5 size-5 text-olive" />
                                <div>
                                    <dt class="text-sm font-semibold text-ink-2">Telephone</dt>
                                    <dd class="mt-2 space-y-1">
                                        @foreach (config('company.contact.phones') as $phone)
                                            <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="link-line block w-fit font-normal text-ink-2">{{ $phone }}</a>
                                        @endforeach
                                    </dd>
                                </div>
                            </div>
                            <div class="flex gap-4 py-6">
                                <x-icon name="mail" class="mt-0.5 size-5 text-olive" />
                                <div>
                                    <dt class="text-sm font-semibold text-ink-2">Email</dt>
                                    <dd class="mt-2">
                                        @if ($email)
                                            <a href="mailto:{{ $email }}" class="link-line font-normal text-ink-2">{{ $email }}</a>
                                        @else
                                            <span class="text-stone">Use the form on this page.</span>
                                            <div class="mt-3"><x-confirm>Official email to be confirmed</x-confirm></div>
                                        @endif
                                    </dd>
                                </div>
                            </div>
                        </dl>

                        <div class="mt-10 bg-cream p-7" data-reveal>
                            <p class="font-semibold text-ink-2">Commercial requirements?</p>
                            <p class="mt-2 text-sm leading-relaxed text-stone">For product, supply or partnership requests, our business inquiry form captures the details our commercial team needs.</p>
                            <a href="{{ route('inquiry') }}" class="link-line mt-4 text-sm text-ink-2">Business inquiry form →</a>
                        </div>
                    </div>
                </aside>

                {{-- Form --}}
                <div class="lg:col-span-8" id="contact-form">
                    <p class="eyebrow" data-reveal>Send a message</p>
                    <h2 class="text-h2 mt-6 mb-12" data-split>How can we help?</h2>

                    <x-form.status />

                    <form method="POST" action="{{ route('contact.submit') }}" class="relative" x-data="inquiryForm" x-on:submit="submit" novalidate>
                        @csrf

                        <fieldset>
                            <legend class="field-label mb-4">Inquiry type <span class="text-olive" aria-hidden="true">*</span></legend>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($inquiryTypes as $value => $label)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="inquiry_type" value="{{ $value }}" class="peer sr-only" @checked(old('inquiry_type', $selectedType) === $value) required>
                                        <span class="inline-flex min-h-11 items-center px-5 text-sm font-medium ring-1 ring-ink-2/15 transition-colors ring-inset peer-checked:bg-ink-2 peer-checked:text-white peer-checked:ring-ink-2 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2 peer-focus-visible:outline-accent-strong hover:ring-ink-2/40">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('inquiry_type')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </fieldset>

                        <div class="mt-12 grid gap-x-8 gap-y-10 sm:grid-cols-2">
                            <x-form.field name="full_name" label="Full name" required autocomplete="name" maxlength="120" />
                            <x-form.field name="company_name" label="Company name" autocomplete="organization" maxlength="160" />
                            <x-form.field name="email" type="email" label="Email" required autocomplete="email" maxlength="190" />
                            <x-form.field name="phone" type="tel" label="Phone" autocomplete="tel" maxlength="40" />
                            <x-form.field name="country" label="Country" required autocomplete="country-name" maxlength="80" class="sm:col-span-2" />
                            <x-form.field name="message" type="textarea" label="Message" required maxlength="5000" rows="6" class="sm:col-span-2" />
                        </div>

                        <div class="mt-10 space-y-8">
                            <x-form.consent />
                            <x-buttons.submit x-bind:disabled="sending">
                                <span x-text="sending ? 'Sending…' : 'Send Message'">Send Message</span>
                            </x-buttons.submit>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Map --}}
    <section class="bg-cream">
        <div class="grid lg:grid-cols-12">
            <div class="flex flex-col justify-center px-5 py-16 sm:px-12 lg:col-span-4 lg:px-14">
                <p class="eyebrow" data-reveal>Find us</p>
                <h2 class="text-h3 mt-5" data-split>Rruga “Sulejman Delvina”, Tirana</h2>
                <p class="mt-4 leading-relaxed text-stone" data-reveal>Our registered headquarters is located on Rruga “Sulejman Delvina” in Administrative Unit No. 5, Tirana.</p>
                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($hq['map_query']) }}" target="_blank" rel="noopener noreferrer" class="link-line mt-6 w-fit text-sm text-ink-2" data-reveal>
                    Open in Google Maps <x-icon name="arrow-up-right" class="size-4" />
                </a>
            </div>
            <div class="relative aspect-[4/3] bg-graphite lg:col-span-8 lg:aspect-auto lg:min-h-[30rem]" x-data="{ load: false }">
                <template x-if="load">
                    <iframe
                        title="Map showing Rruga Sulejman Delvina, Tirana"
                        src="https://www.google.com/maps?q={{ urlencode($hq['map_query']) }}&output=embed"
                        class="absolute inset-0 size-full border-0 grayscale-[0.6]"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </template>
                <div x-show="!load" class="absolute inset-0">
                    <x-img key="office-sky" sizes="(min-width: 1024px) 66vw, 100vw" alt="" class="opacity-50" />
                    <div class="absolute inset-0 grid place-items-center p-6 text-center">
                        <div class="max-w-sm bg-ink/85 p-7 text-white backdrop-blur-md">
                            <p class="font-semibold">Interactive map</p>
                            <p class="mt-2 text-sm text-white/70">Loading the map connects to Google Maps, which may set its own cookies.</p>
                            <button type="button" x-on:click="load = true" class="mt-5 min-h-11 cursor-pointer bg-accent px-5 text-sm font-semibold text-ink hover:bg-white">Load map</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
