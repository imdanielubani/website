@props([
    'image',
    'reverse' => false,
    'ratio' => 'aspect-[4/5]',
    'caption' => null,
])

<div {{ $attributes->class(['grid items-center gap-12 lg:grid-cols-12 lg:gap-20']) }}>
    <figure class="lg:col-span-6 {{ $reverse ? 'lg:order-2' : '' }}">
        <div class="img-frame {{ $ratio }}" data-reveal="clip">
            <div data-parallax="10" class="size-full">
                <x-img :key="$image" sizes="(min-width: 1024px) 50vw, 100vw" />
            </div>
        </div>
        @if ($caption)
            <figcaption class="mt-4 text-sm text-stone">{{ $caption }}</figcaption>
        @endif
    </figure>
    <div class="lg:col-span-6 {{ $reverse ? 'lg:order-1' : '' }}">
        {{ $slot }}
    </div>
</div>
