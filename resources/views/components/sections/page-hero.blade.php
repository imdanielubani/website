@props([
    'eyebrow' => null,
    'title',
    'lead' => null,
    'image' => 'refinery-river',
    'breadcrumbs' => [],
    'size' => 'lg', // lg | md
])

@php
    $eyebrow = $eyebrow ? t($eyebrow) : null;
    $title = t($title);
    $lead = $lead ? t($lead) : null;
    $breadcrumbs = array_map(fn ($crumb) => ['name' => t($crumb['name'])] + $crumb, $breadcrumbs);
@endphp

<section data-hero class="on-dark relative isolate flex overflow-hidden bg-ink text-white {{ $size === 'lg' ? 'min-h-[82svh] sm:min-h-[88svh]' : 'min-h-[62svh] sm:min-h-[70svh]' }}">
    <div class="absolute inset-0 -z-10">
        <div data-hero-media class="size-full will-change-transform">
            <x-img :key="$image" eager sizes="100vw" alt="" />
        </div>
        <div class="overlay-hero absolute inset-0"></div>
    </div>

    <div class="container-site flex flex-col justify-end pt-36 pb-14 sm:pb-20">
        @if (count($breadcrumbs))
            <nav aria-label="{{ __('Breadcrumb') }}" data-hero-item class="mb-8">
                <ol class="flex flex-wrap items-center gap-2 text-sm text-white/60">
                    <li><a href="{{ lroute('home') }}" class="hover:text-white">{{ __('Home') }}</a></li>
                    @foreach ($breadcrumbs as $crumb)
                        <li aria-hidden="true">/</li>
                        <li>
                            @if (! $loop->last && isset($crumb['url']))
                                <a href="{{ $crumb['url'] }}" class="hover:text-white">{{ $crumb['name'] }}</a>
                            @else
                                <span aria-current="page" class="text-white">{{ $crumb['name'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        <div class="grid items-end gap-10 lg:grid-cols-12">
            <div class="lg:col-span-8">
                @if ($eyebrow)
                    <p class="eyebrow mb-6 text-white/75" data-hero-item>{{ $eyebrow }}</p>
                @endif
                <h1 data-hero-title class="text-h1 max-w-5xl font-semibold">{{ $title }}</h1>
            </div>
            @if ($lead)
                <div class="lg:col-span-4 lg:pb-2">
                    <p class="lead" data-hero-item>{{ $lead }}</p>
                </div>
            @endif
        </div>

        {{ $slot }}
    </div>
</section>
