@php
    $nav = config('navigation');
    $isActive = function (array $item): bool {
        if (isset($item['route'])) {
            return request()->routeIs($item['route'], $item['route'] . '.*');
        }

        return collect($item['children'] ?? [])->contains(fn ($child) => request()->routeIs($child['route']));
    };
@endphp

<header
    x-data="siteHeader"
    x-on:keydown.escape.window="closeAll()"
    x-trap.noscroll="mobileOpen"
    class="on-dark fixed inset-x-0 top-0 z-50 text-white transition-[transform,background-color,box-shadow] duration-700 ease-out-expo"
    :class="{
        'bg-ink/88 backdrop-blur-xl shadow-[0_1px_0_rgb(255_255_255/0.08)]': (scrolled || panel !== null) && !mobileOpen,
        '-translate-y-full': hidden && panel === null && !mobileOpen,
    }"
>
    <div class="container-site flex items-center justify-between gap-6 transition-[height] duration-700 ease-out-expo h-20 sm:h-22" :class="scrolled && 'h-18!'">
        <x-logo tone="dark" :href="route('home')" class="relative z-10" />

        {{-- Desktop navigation --}}
        <nav aria-label="Primary" class="hidden xl:block">
            <ul class="flex items-center gap-9">
                @foreach ($nav as $index => $item)
                    <li>
                        @isset($item['children'])
                            <button
                                type="button"
                                class="nav-link inline-flex cursor-pointer items-center gap-1.5 {{ $isActive($item) ? 'text-white' : 'text-white/80 hover:text-white' }}"
                                @if ($isActive($item)) aria-current="page" @endif
                                :aria-expanded="(panel === {{ $index }}).toString()"
                                aria-controls="mega-{{ $index }}"
                                x-on:click="toggle({{ $index }})"
                                x-on:mouseenter="open({{ $index }})"
                                x-on:mouseleave="scheduleClose()"
                            >
                                {{ $item['label'] }}
                                <svg viewBox="0 0 16 16" class="size-3.5 transition-transform duration-500" :class="panel === {{ $index }} && 'rotate-180'" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="m4 6 4 4 4-4" /></svg>
                            </button>
                        @else
                            <a
                                href="{{ route($item['route']) }}"
                                class="nav-link {{ $isActive($item) ? 'text-white' : 'text-white/80 hover:text-white' }}"
                                @if ($isActive($item)) aria-current="page" @endif
                            >{{ $item['label'] }}</a>
                        @endisset
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="flex items-center gap-3">
            <x-buttons.primary :href="route('contact')" class="hidden sm:inline-flex">Contact Us</x-buttons.primary>

            <button
                type="button"
                class="relative z-10 grid size-12 cursor-pointer place-items-center bg-white/10 ring-1 ring-white/20 backdrop-blur-md ring-inset xl:hidden"
                x-on:click="toggleMobile()"
                :aria-expanded="mobileOpen.toString()"
                aria-controls="mobile-menu"
            >
                <span class="sr-only" x-text="mobileOpen ? 'Close menu' : 'Open menu'">Open menu</span>
                <span class="relative block h-3 w-5" aria-hidden="true">
                    <span class="absolute left-0 h-px w-5 bg-current transition-all duration-500 ease-out-expo" :class="mobileOpen ? 'top-1.5 rotate-45' : 'top-0'"></span>
                    <span class="absolute left-0 h-px bg-current transition-all duration-500 ease-out-expo" :class="mobileOpen ? 'top-1.5 w-5 -rotate-45' : 'top-3 w-3'"></span>
                </span>
            </button>
        </div>
    </div>

    {{-- Desktop mega menus --}}
    @foreach ($nav as $index => $item)
        @isset($item['children'])
            <div
                id="mega-{{ $index }}"
                x-cloak
                x-show="panel === {{ $index }}"
                x-transition:enter="transition duration-500 ease-out-expo"
                x-transition:enter-start="opacity-0 -translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition duration-300 ease-out"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-on:mouseenter="cancelClose()"
                x-on:mouseleave="scheduleClose()"
                class="absolute inset-x-0 top-full hidden border-t border-white/10 bg-ink xl:block"
            >
                <div class="container-site grid grid-cols-12 gap-10 py-12">
                    <div class="col-span-3 flex flex-col justify-between">
                        <div>
                            <p class="eyebrow text-white/60">{{ $item['label'] }}</p>
                            <p class="mt-5 text-lg leading-relaxed text-white/80">{{ $item['intro'] }}</p>
                        </div>
                        <a href="{{ route('inquiry') }}" class="link-line mt-8 self-start text-sm text-accent">Start a business inquiry</a>
                    </div>
                    <ul class="col-span-9 grid gap-5 {{ count($item['children']) > 2 ? 'grid-cols-4' : 'grid-cols-2' }}">
                        @foreach ($item['children'] as $child)
                            <li>
                                <a href="{{ route($child['route']) }}" class="group block" @if (request()->routeIs($child['route'])) aria-current="page" @endif>
                                    <div class="img-frame img-zoom aspect-[4/3]">
                                        <x-img :key="$child['image']" sizes="22vw" alt="" />
                                        <div class="absolute inset-0 bg-ink/20 transition-colors duration-700 group-hover:bg-ink/0"></div>
                                    </div>
                                    <div class="mt-4 flex items-start justify-between gap-3">
                                        <div>
                                            <p class="font-display text-lg font-semibold tracking-[-0.02em]">{{ $child['label'] }}</p>
                                            <p class="mt-1 text-sm text-white/60">{{ $child['text'] }}</p>
                                        </div>
                                        <svg viewBox="0 0 16 16" class="mt-1.5 size-4 shrink-0 text-accent transition-transform duration-500 ease-out-expo group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" /></svg>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endisset
    @endforeach

    {{-- Mobile navigation --}}
    <div
        id="mobile-menu"
        x-cloak
        x-show="mobileOpen"
        x-transition:enter="transition duration-700 ease-out-expo"
        x-transition:enter-start="opacity-0 [clip-path:inset(0_0_100%_0)]"
        x-transition:enter-end="opacity-100 [clip-path:inset(0_0_0_0)]"
        x-transition:leave="transition duration-500 ease-in-out-quart"
        x-transition:leave-start="opacity-100 [clip-path:inset(0_0_0_0)]"
        x-transition:leave-end="opacity-0 [clip-path:inset(0_0_100%_0)]"
        class="fixed inset-0 z-0 flex h-dvh flex-col overflow-y-auto overscroll-contain bg-ink pt-24 xl:hidden"
        role="dialog"
        aria-modal="true"
        aria-label="Site menu"
    >
        <nav aria-label="Mobile" class="container-site flex-1 pb-10">
            <ul class="divide-y divide-white/10 border-y border-white/10">
                @foreach ($nav as $index => $item)
                    <li x-data="{ expanded: {{ $isActive($item) && isset($item['children']) ? 'true' : 'false' }} }">
                        @isset($item['children'])
                            <button
                                type="button"
                                class="flex w-full cursor-pointer items-center justify-between py-5 text-left font-display text-[1.75rem] font-semibold tracking-[-0.03em]"
                                x-on:click="expanded = !expanded"
                                :aria-expanded="expanded.toString()"
                            >
                                {{ $item['label'] }}
                                <span class="grid size-9 place-items-center bg-white/8" aria-hidden="true">
                                    <svg viewBox="0 0 16 16" class="size-4 transition-transform duration-500" :class="expanded && 'rotate-45'" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 3v10M3 8h10" /></svg>
                                </span>
                            </button>
                            <ul x-show="expanded" x-collapse class="space-y-1 pb-5">
                                @foreach ($item['children'] as $child)
                                    <li>
                                        <a href="{{ route($child['route']) }}" class="flex items-center justify-between gap-4 py-2.5 text-lg text-white/75 hover:text-white" @if (request()->routeIs($child['route'])) aria-current="page" @endif>
                                            {{ $child['label'] }}
                                            <svg viewBox="0 0 16 16" class="size-4 text-accent" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" /></svg>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ route($item['route']) }}" class="block py-5 font-display text-[1.75rem] font-semibold tracking-[-0.03em] {{ $isActive($item) ? 'text-accent' : '' }}" @if ($isActive($item)) aria-current="page" @endif>{{ $item['label'] }}</a>
                        @endisset
                    </li>
                @endforeach
                <li>
                    <a href="{{ route('contact') }}" class="block py-5 font-display text-[1.75rem] font-semibold tracking-[-0.03em] {{ request()->routeIs('contact') ? 'text-accent' : '' }}">Contact</a>
                </li>
            </ul>

            <div class="mt-10 grid gap-8 sm:grid-cols-2">
                <div>
                    <p class="eyebrow text-white/50">Call</p>
                    <ul class="mt-3 space-y-1 text-lg">
                        @foreach (config('company.contact.phones') as $phone)
                            <li><a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="hover:text-accent">{{ $phone }}</a></li>
                        @endforeach
                    </ul>
                    @if (config('company.contact.email'))
                        <p class="eyebrow mt-8 text-white/50">Email</p>
                        <a href="mailto:{{ config('company.contact.email') }}" class="mt-3 block text-lg break-all hover:text-accent">{{ config('company.contact.email') }}</a>
                    @endif
                </div>
                <div>
                    <p class="eyebrow text-white/50">Headquarters</p>
                    <p class="mt-3 text-white/70">{{ implode(', ', config('company.locations.tirana.lines')) }}</p>
                </div>
            </div>

            <x-buttons.primary :href="route('inquiry')" class="mt-10 w-full justify-between sm:hidden">Business Inquiry</x-buttons.primary>
        </nav>
    </div>
</header>
