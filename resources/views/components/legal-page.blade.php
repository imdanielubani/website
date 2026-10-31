@props([
    'title',
    'description',
    'lead',
    'updated', // Y-m-d
    'toc' => [], // anchor => heading
])

@php
    $updated = \Illuminate\Support\Carbon::parse($updated)->translatedFormat('j F Y');
@endphp

<x-layouts.app :title="$title" :description="$description" image="office-sky" :breadcrumbs="[['name' => $title]]">
    <x-sections.page-hero :eyebrow="__('Legal')" :title="$title" :lead="$lead" image="office-sky" size="md" :breadcrumbs="[['name' => $title]]" />

    <section class="section bg-paper">
        <div class="container-site">
            <div class="grid gap-14 lg:grid-cols-12">
                <aside class="lg:col-span-3">
                    <div class="lg:sticky lg:top-32">
                        <p class="text-sm text-stone">{{ __('Last updated') }}</p>
                        <p class="mt-1 font-semibold text-ink-2">{{ $updated }}</p>
                        @if (count($toc))
                            <nav aria-label="{{ __('Contents') }}" class="mt-10 hidden border-t border-line pt-8 lg:block">
                                <p class="eyebrow">{{ __('Contents') }}</p>
                                <ol class="mt-5 space-y-3 text-sm">
                                    @foreach ($toc as $anchor => $heading)
                                        <li><a href="#{{ $anchor }}" class="text-stone hover:text-ink-2">{{ t($heading) }}</a></li>
                                    @endforeach
                                </ol>
                            </nav>
                        @endif
                    </div>
                </aside>
                <div class="lg:col-span-8 lg:col-start-5">
                    <div class="mb-12 border-l-2 border-accent-strong bg-cream p-6 text-sm leading-relaxed text-stone">
                        <strong class="text-ink-2">{{ __('Please note:') }}</strong> {{ __('this document is provided as an editable template for :company. It is not legal advice and should be reviewed by qualified legal counsel, including for compliance with applicable Albanian data protection legislation, before publication.', ['company' => config('company.name')]) }}
                    </div>
                    <div class="prose-site">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
