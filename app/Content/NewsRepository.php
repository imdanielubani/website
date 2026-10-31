<?php

namespace App\Content;

use Illuminate\Support\Collection;

/**
 * Reads news articles from a version-controlled content file.
 *
 * The site has no database: articles live in resources/content/news.php and
 * are edited like any other source file. The repository is the single access
 * point, so it can later be swapped for a CMS or database-backed source
 * without touching controllers or views.
 */
class NewsRepository
{
    /** @var array<string, Collection<int, NewsArticle>> keyed by language */
    private array $articles = [];

    public function __construct(private readonly string $path) {}

    /** @return Collection<int, NewsArticle> in the current language */
    public function all(): Collection
    {
        $locale = app()->getLocale();

        return $this->articles[$locale] ??= collect(require $this->path)
            ->map(fn (array $data) => NewsArticle::fromArray($data, $locale))
            ->sortByDesc(fn (NewsArticle $a) => $a->publishedAt?->timestamp ?? 0)
            ->values();
    }

    /** @return Collection<int, NewsArticle> */
    public function published(): Collection
    {
        return $this->all()->filter->isLive()->values();
    }

    public function find(string $slug): ?NewsArticle
    {
        return $this->published()->first(fn (NewsArticle $a) => $a->slug === $slug);
    }

    /** @return Collection<int, NewsArticle> */
    public function inCategory(string $categorySlug): Collection
    {
        return $this->published()
            ->filter(fn (NewsArticle $a) => $a->categorySlug() === $categorySlug)
            ->values();
    }

    /** @return Collection<string, string> slug => label */
    public function categories(): Collection
    {
        return $this->published()
            ->mapWithKeys(fn (NewsArticle $a) => [$a->categorySlug() => $a->category])
            ->sort();
    }

    /** @return Collection<int, NewsArticle> */
    public function related(NewsArticle $article, int $limit = 3): Collection
    {
        $others = $this->published()->reject(fn (NewsArticle $a) => $a->slug === $article->slug);

        return $others
            ->sortByDesc(fn (NewsArticle $a) => $a->category === $article->category)
            ->take($limit)
            ->values();
    }
}
