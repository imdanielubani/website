<?php

namespace App\Content;

use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

/**
 * A single news or insight article loaded from resources/content/news.php.
 */
final class NewsArticle
{
    public function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly string $excerpt,
        public readonly string $content,
        public readonly string $featuredImage,
        public readonly string $category,
        public readonly string $author,
        public readonly ?Carbon $publishedAt,
        public readonly bool $isPublished,
        public readonly ?string $seoTitle = null,
        public readonly ?string $seoDescription = null,
        public readonly bool $isSample = false,
    ) {}

    /**
     * Build an article in the given language. Translated fields are read
     * from $data[$locale] (title, excerpt, content, seo_title,
     * seo_description) and fall back to the default-language values.
     */
    public static function fromArray(array $data, ?string $locale = null): self
    {
        $locale ??= app()->getLocale();
        $data = array_merge($data, $data[$locale] ?? []);

        return new self(
            title: $data['title'],
            slug: $data['slug'] ?? Str::slug($data['title']),
            excerpt: $data['excerpt'],
            content: $data['content'],
            featuredImage: $data['featured_image'],
            category: $data['category'],
            author: $data['author'] ?? config('company.name'),
            publishedAt: isset($data['published_at']) ? Carbon::parse($data['published_at']) : null,
            isPublished: (bool) ($data['is_published'] ?? false),
            seoTitle: $data['seo_title'] ?? null,
            seoDescription: $data['seo_description'] ?? null,
            isSample: (bool) ($data['is_sample'] ?? false),
        );
    }

    public function isLive(): bool
    {
        return $this->isPublished && $this->publishedAt && $this->publishedAt->isPast();
    }

    public function html(): HtmlString
    {
        return new HtmlString(Str::markdown($this->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]));
    }

    public function categorySlug(): string
    {
        return Str::slug($this->category);
    }

    public function url(): string
    {
        return lroute('news.show', $this->slug);
    }

    public function readingMinutes(): int
    {
        return max(1, (int) ceil(str_word_count(strip_tags($this->content)) / 220));
    }
}
