@props(['code', 'title', 'text'])

<x-layouts.app :title="$title" :description="$text">
    <section data-hero class="on-dark relative isolate flex min-h-svh overflow-hidden bg-ink text-white">
        <div class="absolute inset-0 -z-10">
            <div data-hero-media class="size-full">
                <x-img key="pipes-building" eager sizes="100vw" alt="" class="opacity-35" />
            </div>
            <div class="overlay-hero absolute inset-0"></div>
        </div>
        <div class="container-site flex flex-col justify-end pt-40 pb-20">
            <p class="font-display text-[clamp(6rem,4rem+14vw,18rem)] leading-[0.8] font-extrabold tracking-[-0.06em] text-white/10" data-hero-item>{{ $code }}</p>
            <h1 data-hero-title class="text-h1 mt-6 max-w-3xl">{{ $title }}</h1>
            <p class="lead mt-6 max-w-xl" data-hero-item>{{ $text }}</p>
            <div class="mt-10 flex flex-wrap gap-3" data-hero-item>
                {{ $slot }}
            </div>
        </div>
    </section>
</x-layouts.app>
