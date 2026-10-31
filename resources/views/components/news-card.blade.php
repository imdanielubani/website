@props(['article', 'size' => 'md'])

<article {{ $attributes->class(['group relative flex flex-col']) }}>
    <div class="img-frame img-zoom aspect-[4/3]">
        <x-img :key="$article->featuredImage" sizes="(min-width: 768px) 33vw, 100vw" alt="" />
    </div>
    <div class="mt-6 flex items-center gap-3 text-sm text-stone">
        <a href="{{ route('news.category', $article->categorySlug()) }}" class="relative z-10 font-semibold text-olive hover:text-ink-2">{{ $article->category }}</a>
        <span aria-hidden="true">&middot;</span>
        <time datetime="{{ $article->publishedAt->toDateString() }}">{{ $article->publishedAt->format('j M Y') }}</time>
    </div>
    <h3 class="mt-3 font-display text-xl font-semibold tracking-[-0.025em] text-balance sm:text-[1.4rem]">
        <a href="{{ $article->url() }}" class="after:absolute after:inset-0 group-hover:underline group-hover:decoration-accent-strong group-hover:decoration-2 group-hover:underline-offset-4">{{ $article->title }}</a>
    </h3>
    <p class="mt-3 line-clamp-3 leading-relaxed text-stone">{{ $article->excerpt }}</p>
</article>
