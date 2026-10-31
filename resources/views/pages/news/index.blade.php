@php
    $categoryName = $activeCategory ? $categories[$activeCategory] : null;
    $crumbs = $activeCategory
        ? [['name' => 'News', 'url' => lroute('news.index')], ['name' => $categoryName]]
        : [['name' => 'News']];
@endphp

<x-layouts.app
    :title="$categoryName ? t($categoryName) . ' | ' . __('News & Insights') : __('News & Insights')"
    :description="$categoryName
        ? __(':category articles from AL.GLOBAL OIL SH.A.', ['category' => t($categoryName)])
        : 'News, insights and company updates from AL.GLOBAL OIL SH.A, an Albanian petroleum and hydrocarbons company.'"
    image="ship-sea"
    :breadcrumbs="$crumbs"
    :canonical="$articles->currentPage() > 1 ? $articles->url($articles->currentPage()) : url()->current()"
>
    <x-sections.page-hero
        eyebrow="News & Insights"
        :title="$categoryName ? t($categoryName) : __('Perspectives on energy and our business')"
        lead="Company updates, industry context and practical insights from AL.GLOBAL OIL."
        image="ship-sea"
        size="md"
        :breadcrumbs="$crumbs"
    />

    <section class="section-tight bg-paper">
        <div class="container-site">

            {{-- Categories --}}
            <nav aria-label="{{ __('Article categories') }}" class="-mx-5 overflow-x-auto px-5 sm:mx-0 sm:px-0">
                <ul class="flex w-max gap-2 sm:w-auto sm:flex-wrap">
                    <li>
                        <a href="{{ lroute('news.index') }}" class="inline-flex min-h-11 items-center px-5 text-sm font-medium ring-1 ring-inset transition-colors {{ $activeCategory ? 'ring-ink-2/15 hover:ring-ink-2/40' : 'bg-ink-2 text-white ring-ink-2' }}" @unless ($activeCategory) aria-current="page" @endunless>{{ __('All') }}</a>
                    </li>
                    @foreach ($categories as $slug => $label)
                        <li>
                            <a href="{{ lroute('news.category', $slug) }}" class="inline-flex min-h-11 items-center px-5 text-sm font-medium ring-1 ring-inset transition-colors {{ $activeCategory === $slug ? 'bg-ink-2 text-white ring-ink-2' : 'ring-ink-2/15 hover:ring-ink-2/40' }}" @if ($activeCategory === $slug) aria-current="page" @endif>{{ t($label) }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            {{-- Featured article --}}
            @if ($featured && $articles->currentPage() === 1)
                <article class="group relative mt-14 grid overflow-hidden bg-ink text-white lg:grid-cols-12">
                    <div class="img-frame img-zoom aspect-[16/10] lg:col-span-7 lg:aspect-auto lg:min-h-[32rem]">
                        <x-img :key="$featured->featuredImage" sizes="(min-width: 1024px) 58vw, 100vw" alt="" />
                    </div>
                    <div class="on-dark flex flex-col justify-between gap-10 p-8 sm:p-12 lg:col-span-5">
                        <div>
                            <p class="eyebrow text-white/70">{{ __('Featured') }}</p>
                            <div class="mt-8 flex items-center gap-3 text-sm text-white/60">
                                <a href="{{ lroute('news.category', $featured->categorySlug()) }}" class="relative z-10 font-semibold text-accent">{{ t($featured->category) }}</a>
                                <span aria-hidden="true">{{ __('·') }}</span>
                                <time datetime="{{ $featured->publishedAt->toDateString() }}">{{ $featured->publishedAt->translatedFormat('j F Y') }}</time>
                            </div>
                            <h2 class="mt-4 font-display text-[clamp(1.75rem,1.3rem+1.6vw,2.75rem)] leading-tight font-semibold tracking-[-0.03em]">
                                <a href="{{ $featured->url() }}" class="after:absolute after:inset-0">{{ $featured->title }}</a>
                            </h2>
                            <p class="mt-5 leading-relaxed text-white/65">{{ $featured->excerpt }}</p>
                        </div>
                        <span class="inline-flex items-center gap-3 text-sm font-semibold text-accent">
                            {{ __('Read article') }}
                            <x-icon name="arrow-up-right" class="size-4 transition-transform duration-500 group-hover:translate-x-1 group-hover:-translate-y-1" />
                        </span>
                    </div>
                </article>
            @endif

            {{-- Grid --}}
            @if ($articles->isNotEmpty())
                <div class="mt-16 grid gap-x-6 gap-y-14 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                    @foreach ($articles as $article)
                        <x-news-card :article="$article" />
                    @endforeach
                </div>
            @elseif (! $featured)
                <p class="mt-16 text-lead text-stone">{{ __('No articles have been published yet.') }}</p>
            @endif

            @if ($articles->hasPages())
                <div class="mt-16">
                    {{ $articles->links() }}
                </div>
            @endif

            @if ($articles->getCollection()->contains->isSample || $featured?->isSample)
                <div class="mt-16">
                    <x-confirm>{{ __('Sample articles shown for layout purposes. Replace with company news before launch') }}</x-confirm>
                </div>
            @endif
        </div>
    </section>

    <x-sections.cta
        eyebrow="Media & business"
        title="Have a question for our team?"
        text="For media requests or business inquiries, get in touch and we will respond promptly."
        image="refinery-dusk"
    />
</x-layouts.app>
