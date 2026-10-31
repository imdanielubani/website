@props([
    'eyebrow' => 'Work with us',
    'title',
    'text' => null,
    'image' => 'refinery-dusk',
    'primary' => ['label' => 'Contact Our Team', 'route' => 'contact'],
    'secondary' => ['label' => 'Business Inquiry', 'route' => 'inquiry'],
])

<section class="on-dark relative isolate overflow-hidden bg-ink text-white">
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div data-parallax="14" class="size-full">
            <x-img :key="$image" sizes="100vw" alt="" />
        </div>
        <div class="overlay-side absolute inset-0"></div>
    </div>

    <div class="container-site section">
        <div class="max-w-3xl">
            <p class="eyebrow mb-6 text-white/75" data-reveal>{{ $eyebrow }}</p>
            <h2 class="text-h2" data-split>{{ $title }}</h2>
            @if ($text)
                <p class="lead mt-6 max-w-2xl" data-reveal>{{ $text }}</p>
            @endif
            <div class="mt-10 flex flex-wrap gap-3" data-reveal data-delay="0.15">
                @if ($primary)
                    <x-buttons.primary :href="route($primary['route'])">{{ $primary['label'] }}</x-buttons.primary>
                @endif
                @if ($secondary)
                    <x-buttons.primary :href="route($secondary['route'])" variant="ghost">{{ $secondary['label'] }}</x-buttons.primary>
                @endif
            </div>
        </div>
    </div>
</section>
