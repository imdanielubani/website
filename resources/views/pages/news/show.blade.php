@php
    $crumbs = [
        ['name' => 'News', 'url' => route('news.index')],
        ['name' => $article->category, 'url' => route('news.category', $article->categorySlug())],
        ['name' => $article->title],
    ];

    $schema = [
        '@type' => 'Article',
        'headline' => $article->title,
        'description' => $article->seoDescription ?? $article->excerpt,
        'image' => asset('images/photos/' . config("images.{$article->featuredImage}.file") . '-lg.webp'),
        'datePublished' => $article->publishedAt->toIso8601String(),
        'author' => ['@type' => 'Organization', 'name' => $article->author],
        'publisher' => ['@id' => url('/') . '#organization'],
        'mainEntityOfPage' => $article->url(),
    ];
@endphp

<x-layouts.app
    :title="$article->seoTitle ?? $article->title"
    :description="$article->seoDescription ?? $article->excerpt"
    :image="$article->featuredImage"
    type="article"
    :breadcrumbs="$crumbs"
    :schema="$schema"
>
    <article>
        <header data-hero class="on-dark relative isolate overflow-hidden bg-ink pt-40 pb-16 text-white sm:pb-20">
            <div class="container-site">
                <nav aria-label="Breadcrumb" data-hero-item>
                    <ol class="flex flex-wrap items-center gap-2 text-sm text-white/60">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                        <li aria-hidden="true">/</li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-white">News</a></li>
                        <li aria-hidden="true">/</li>
                        <li><a href="{{ route('news.category', $article->categorySlug()) }}" class="hover:text-white">{{ $article->category }}</a></li>
                    </ol>
                </nav>
                <h1 data-hero-title class="text-h1 mt-10 max-w-5xl">{{ $article->title }}</h1>
                <div class="mt-10 flex flex-wrap items-center gap-x-8 gap-y-3 border-t border-white/12 pt-6 text-sm text-white/65" data-hero-item>
                    <span class="flex items-center gap-2"><x-icon name="calendar-days" class="size-4 text-accent" /><time datetime="{{ $article->publishedAt->toDateString() }}">{{ $article->publishedAt->format('j F Y') }}</time></span>
                    <span class="flex items-center gap-2"><x-icon name="clock" class="size-4 text-accent" />{{ $article->readingMinutes() }} min read</span>
                    <span>By {{ $article->author }}</span>
                </div>
            </div>
        </header>

        <div class="[background:linear-gradient(var(--color-ink)_60%,var(--color-paper)_60%)] pb-16 sm:pb-24">
            <div class="container-site">
                <div class="img-frame aspect-[16/9] lg:aspect-[21/9]" data-reveal="clip">
                    <div data-parallax="8" class="size-full">
                        <x-img :key="$article->featuredImage" eager sizes="(min-width: 1648px) 1648px, 100vw" />
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-paper pb-20 sm:pb-28">
            <div class="container-site">
                <div class="grid gap-12 lg:grid-cols-12">
                    <aside class="order-2 lg:order-1 lg:col-span-3">
                        <div class="lg:sticky lg:top-32">
                            <p class="text-sm text-stone">Category</p>
                            <a href="{{ route('news.category', $article->categorySlug()) }}" class="mt-1 inline-block font-semibold text-ink-2 hover:text-olive">{{ $article->category }}</a>
                            <div class="mt-8 border-t border-line pt-8">
                                <a href="{{ route('news.index') }}" class="link-line text-sm text-ink-2">← All news</a>
                            </div>
                        </div>
                    </aside>
                    <div class="order-1 max-w-3xl lg:order-2 lg:col-span-8 lg:col-start-5">
                        @if ($article->isSample)
                            <div class="mb-10"><x-confirm>Sample article for layout purposes. Replace before launch</x-confirm></div>
                        @endif
                        <p class="text-xl leading-relaxed text-ink-2">{{ $article->excerpt }}</p>
                        <div class="prose-site mt-10">
                            {{ $article->html() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    @if ($related->isNotEmpty())
        <section class="section border-t border-line bg-cream">
            <div class="container-site">
                <div class="flex flex-wrap items-end justify-between gap-8">
                    <x-sections.heading eyebrow="Keep reading" title="Related articles" />
                    <div data-reveal>
                        <x-buttons.primary :href="route('news.index')" variant="outline">All News</x-buttons.primary>
                    </div>
                </div>
                <div class="mt-14 grid gap-x-6 gap-y-14 md:grid-cols-3" data-stagger>
                    @foreach ($related as $item)
                        <x-news-card :article="$item" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
