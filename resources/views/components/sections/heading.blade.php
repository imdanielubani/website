@props([
    'eyebrow' => null,
    'title',
    'lead' => null,
    'tag' => 'h2',
    'align' => 'left', // left | split
])

@php
    $eyebrow = $eyebrow ? t($eyebrow) : null;
    $title = t($title);
    $lead = $lead ? t($lead) : null;
@endphp

@if ($align === 'split')
    <div {{ $attributes->class(['grid gap-8 lg:grid-cols-12 lg:gap-10']) }}>
        <div class="lg:col-span-7">
            @if ($eyebrow)
                <p class="eyebrow mb-6" data-reveal>{{ $eyebrow }}</p>
            @endif
            <{{ $tag }} class="text-h2" data-split>{{ $title }}</{{ $tag }}>
        </div>
        @if ($lead)
            <div class="lg:col-span-5 lg:self-end">
                <p class="lead" data-reveal>{{ $lead }}</p>
            </div>
        @endif
    </div>
@else
    <div {{ $attributes->class(['max-w-3xl']) }}>
        @if ($eyebrow)
            <p class="eyebrow mb-6" data-reveal>{{ $eyebrow }}</p>
        @endif
        <{{ $tag }} class="text-h2" data-split>{{ $title }}</{{ $tag }}>
        @if ($lead)
            <p class="lead mt-6" data-reveal>{{ $lead }}</p>
        @endif
    </div>
@endif
