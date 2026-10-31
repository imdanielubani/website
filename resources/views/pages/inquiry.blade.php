<x-layouts.app
    title="Supplier & Business Inquiry"
    description="Submit a business inquiry to AL.GLOBAL OIL SH.A: purchasing petroleum products, supplier proposals, commercial partnerships and logistics services in Albania."
    image="tanker-sea"
    :breadcrumbs="[['name' => 'Business Inquiry']]"
>
    <x-sections.page-hero
        eyebrow="Supplier & Business Inquiry"
        title="Start a commercial conversation"
        lead="Tell us about your organisation and requirements. Our commercial team reviews every inquiry and responds directly."
        image="tanker-sea"
        size="md"
        :breadcrumbs="[['name' => 'Business Inquiry']]"
    />

    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-16 lg:grid-cols-12 lg:gap-20">
                <aside class="lg:col-span-4">
                    <div class="lg:sticky lg:top-32">
                        <p class="eyebrow" data-reveal>{{ __('Before you write') }}</p>
                        <h2 class="mt-5 font-display text-3xl font-semibold tracking-[-0.03em]" data-reveal>{{ __('What helps us respond quickly') }}</h2>
                        <ol class="mt-10 space-y-0 border-t border-line" data-stagger>
                            @foreach ([
                                ['Who you are', 'Your company, country and the best person to contact.'],
                                ['What you need', 'Products or services, indicative quantities and timing. Estimates are fine.'],
                                ['For suppliers', 'What you supply, where you operate and the documentation you can provide.'],
                            ] as $i => [$title, $text])
                                <li class="grid grid-cols-[2.5rem_1fr] gap-3 border-b border-line py-6">
                                    <span class="index-num pt-0.5 text-olive">0{{ $i + 1 }}</span>
                                    <div>
                                        <p class="font-semibold text-ink-2">{{ t($title) }}</p>
                                        <p class="mt-1 text-sm leading-relaxed text-stone">{{ t($text) }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                        <p class="mt-8 text-sm leading-relaxed text-stone" data-reveal>{{ __('Please do not include confidential documents in this form. If needed, our team will arrange a secure way to exchange them.') }}</p>
                        <div class="mt-8 flex gap-4" data-reveal>
                            <x-icon name="phone" class="mt-0.5 size-5 text-olive" />
                            <div class="space-y-1">
                                @foreach (config('company.contact.phones') as $phone)
                                    <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="link-line block w-fit font-normal text-ink-2">{{ $phone }}</a>
                                @endforeach
                            </div>
                        </div>
                        @if (config('company.contact.email'))
                            <div class="mt-5 flex gap-4" data-reveal>
                                <x-icon name="mail" class="mt-0.5 size-5 text-olive" />
                                <a href="mailto:{{ config('company.contact.email') }}" class="link-line block w-fit font-normal break-all text-ink-2">{{ config('company.contact.email') }}</a>
                            </div>
                        @endif
                    </div>
                </aside>

                <div class="lg:col-span-8" id="inquiry-form">
                    <p class="eyebrow" data-reveal>{{ __('Business inquiry form') }}</p>
                    <h2 class="text-h2 mt-6 mb-12" data-split>{{ __('Your requirements') }}</h2>

                    <x-form.status />

                    <form method="POST" action="{{ lroute('inquiry.submit') }}" class="relative" x-data="inquiryForm" x-on:submit="submit" novalidate>
                        @csrf

                        <fieldset>
                            <legend class="field-label mb-4">{{ __('I am contacting you about') }} <span class="text-olive" aria-hidden="true">*</span></legend>
                            <div class="grid gap-2 sm:grid-cols-2">
                                @foreach ($inquiryTypes as $value => $label)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="inquiry_type" value="{{ $value }}" class="peer sr-only" @checked(old('inquiry_type', $selectedType) === $value) required>
                                        <span class="flex min-h-14 items-center justify-between gap-3 px-5 text-sm font-medium ring-1 ring-ink-2/15 transition-colors ring-inset peer-checked:bg-ink-2 peer-checked:text-white peer-checked:ring-ink-2 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2 peer-focus-visible:outline-accent-strong hover:ring-ink-2/40">
                                            {{ t($label) }}
                                            <span class="size-2 bg-current opacity-30" aria-hidden="true"></span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('inquiry_type')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </fieldset>

                        <h3 class="mt-14 font-display text-xl font-semibold tracking-[-0.02em]">{{ __('Company details') }}</h3>
                        <div class="mt-8 grid gap-x-8 gap-y-10 sm:grid-cols-2">
                            <x-form.field name="company_name" label="Company name" required autocomplete="organization" maxlength="160" />
                            <x-form.field name="contact_person" label="Contact person" required autocomplete="name" maxlength="120" />
                            <x-form.field name="email" type="email" label="Email" required autocomplete="email" maxlength="190" />
                            <x-form.field name="phone" type="tel" label="Phone" required autocomplete="tel" maxlength="40" />
                            <x-form.field name="country" label="Country" required autocomplete="country-name" maxlength="80" class="sm:col-span-2" />
                        </div>

                        <h3 class="mt-14 font-display text-xl font-semibold tracking-[-0.02em]">{{ __('Requirements') }}</h3>
                        <div class="mt-8 grid gap-x-8 gap-y-10 sm:grid-cols-2">
                            <x-form.field name="product_requirements" type="textarea" rows="3" label="Product requirements" maxlength="1000" hint="For example: product type, grade or specification." class="sm:col-span-2" />
                            <x-form.field name="estimated_quantity" label="Estimated quantity" maxlength="120" hint="Approximate volume and frequency, e.g. per month." class="sm:col-span-2" />
                            <x-form.field name="message" type="textarea" label="Message" required maxlength="5000" rows="6" class="sm:col-span-2" />
                        </div>

                        <div class="mt-10 space-y-8">
                            <x-form.consent />
                            <x-buttons.submit x-bind:disabled="sending">
                                <span x-text="sending ? {{ Js::from(__('Sending…')) }} : {{ Js::from(__('Submit Inquiry')) }}">{{ __('Submit Inquiry') }}</span>
                            </x-buttons.submit>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
