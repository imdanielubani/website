@php
    $business = collect(config('navigation'))->firstWhere('label', 'Business')['children'];
    $responsibility = collect(config('navigation'))->firstWhere('label', 'Responsibility')['children'];
    $email = config('company.contact.email');
@endphp

<footer class="on-dark relative overflow-hidden bg-ink text-white">
    <div class="container-site pt-20 pb-10 sm:pt-28">
        <div class="grid gap-12 border-b border-white/10 pb-16 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <x-logo tone="dark" :href="lroute('home')" />
                <p class="mt-8 max-w-md leading-relaxed text-white/60">
                    {{ __('An Albanian petroleum company established in :year, registered for the wholesale import, export and processing of hydrocarbons, fuels, gas and their by-products.', ['year' => config('company.founded_year')]) }}
                </p>
                <dl class="mt-8 grid max-w-md grid-cols-2 gap-6 text-sm">
                    <div>
                        <dt class="text-white/60">NUIS</dt>
                        <dd class="mt-1 font-medium tracking-wide">{{ config('company.nuis') }}</dd>
                    </div>
                    <div>
                        <dt class="text-white/60">{{ __('Established') }}</dt>
                        <dd class="mt-1 font-medium">{{ \Illuminate\Support\Carbon::parse(config('company.founded'))->translatedFormat('j F Y') }}</dd>
                    </div>
                </dl>
            </div>

            <nav aria-label="{{ __('Footer') }}" class="grid grid-cols-2 gap-10 sm:grid-cols-3 lg:col-span-7">
                <div>
                    <p class="eyebrow text-white/50">{{ __('Company') }}</p>
                    <ul class="mt-6 space-y-3 text-[0.9375rem] text-white/75">
                        <li><a class="link-line font-normal hover:text-white" href="{{ lroute('about') }}">{{ __('About Us') }}</a></li>
                        <li><a class="link-line font-normal hover:text-white" href="{{ lroute('careers') }}">{{ __('Careers') }}</a></li>
                        <li><a class="link-line font-normal hover:text-white" href="{{ lroute('news.index') }}">{{ __('News & Insights') }}</a></li>
                        <li><a class="link-line font-normal hover:text-white" href="{{ lroute('contact') }}">{{ __('Contact') }}</a></li>
                        <li><a class="link-line font-normal hover:text-white" href="{{ lroute('inquiry') }}">{{ __('Business Inquiry') }}</a></li>
                    </ul>
                </div>
                <div>
                    <p class="eyebrow text-white/50">{{ __('Business') }}</p>
                    <ul class="mt-6 space-y-3 text-[0.9375rem] text-white/75">
                        @foreach ($business as $link)
                            <li><a class="link-line font-normal hover:text-white" href="{{ lroute($link['route']) }}">{{ __($link['label']) }}</a></li>
                        @endforeach
                    </ul>
                    <p class="eyebrow mt-10 text-white/50">{{ __('Responsibility') }}</p>
                    <ul class="mt-6 space-y-3 text-[0.9375rem] text-white/75">
                        @foreach ($responsibility as $link)
                            <li><a class="link-line font-normal hover:text-white" href="{{ lroute($link['route']) }}">{{ __($link['label']) }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <p class="eyebrow text-white/50">{{ __('Contact') }}</p>
                    <address class="mt-6 space-y-4 text-[0.9375rem] not-italic text-white/75">
                        <p>
                            @foreach (config('company.locations.tirana.lines') as $line)
                                {{ $line }}<br>
                            @endforeach
                        </p>
                        {{-- Phone numbers hidden for now. Remove this comment to show them again.
                        <p>
                            @foreach (config('company.contact.phones') as $phone)
                                <a class="link-line inline-block py-0.5 font-normal hover:text-white" href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a><br>
                            @endforeach
                        </p>
                        --}}
                        @if ($email)
                            <p><a class="link-line inline-block py-0.5 font-normal hover:text-white" href="mailto:{{ $email }}">{{ $email }}</a></p>
                        @else
                            <p><a class="link-line font-normal hover:text-white" href="{{ lroute('contact') }}">{{ __('Send us a message') }}</a></p>
                        @endif
                    </address>
                </div>
            </nav>
        </div>

        <div class="flex flex-col gap-6 pt-8 text-sm text-white/50 md:flex-row md:items-center md:justify-between">
            <p>&copy; {{ now()->year }} {{ config('company.name') }}. {{ __('All rights reserved.') }}</p>
            <ul class="flex flex-wrap gap-x-7 gap-y-2">
                <li><a class="hover:text-white" href="{{ lroute('legal.privacy') }}">{{ __('Privacy Policy') }}</a></li>
                <li><a class="hover:text-white" href="{{ lroute('legal.cookies') }}">{{ __('Cookie Policy') }}</a></li>
                <li><a class="hover:text-white" href="{{ lroute('legal.terms') }}">{{ __('Terms & Conditions') }}</a></li>
                <li><button type="button" class="cursor-pointer hover:text-white" x-data x-on:click="$dispatch('open-cookie-settings')">{{ __('Cookie Settings') }}</button></li>
            </ul>
            <a href="#main" class="group inline-flex items-center gap-3 text-white/70 hover:text-white" data-scroll-top>
                {{ __('Back to top') }}
                <span class="grid size-9 place-items-center bg-white/8 transition-colors group-hover:bg-accent group-hover:text-ink" aria-hidden="true">
                    <svg viewBox="0 0 16 16" class="size-4" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 13V3M4 7l4-4 4 4" /></svg>
                </span>
            </a>
        </div>
    </div>

    <div class="pointer-events-none select-none overflow-hidden" aria-hidden="true">
        <p class="container-site -mb-[0.2em] translate-y-[0.06em] font-display text-[19vw] leading-[0.8] font-extrabold tracking-[-0.06em] whitespace-nowrap text-white/[0.04]" data-footer-word>AL.GLOBAL</p>
    </div>
</footer>
