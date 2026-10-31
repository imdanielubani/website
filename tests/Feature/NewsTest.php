<?php

namespace Tests\Feature;

use App\Content\NewsRepository;
use Tests\TestCase;

class NewsTest extends TestCase
{
    public function test_article_page_renders(): void
    {
        $article = app(NewsRepository::class)->published()->first();

        $this->get(route('news.show', $article->slug))
            ->assertOk()
            ->assertSee($article->title)
            ->assertSee('"@type":"Article"', false)
            ->assertSee('Related articles');
    }

    public function test_category_page_filters_articles(): void
    {
        $repository = app(NewsRepository::class);
        $slug = $repository->categories()->keys()->first();

        $response = $this->get(route('news.category', $slug))->assertOk();

        foreach ($repository->inCategory($slug) as $article) {
            $response->assertSee($article->title);
        }
    }

    public function test_drafts_and_unknown_articles_are_not_found(): void
    {
        $this->get(route('news.show', 'draft-example'))->assertNotFound();
        $this->get(route('news.show', 'no-such-article'))->assertNotFound();
        $this->get(route('news.category', 'no-such-category'))->assertNotFound();
        $this->get(route('news.index', ['page' => 99]))->assertNotFound();
    }

    public function test_only_live_articles_are_published(): void
    {
        $published = app(NewsRepository::class)->published();

        $this->assertNotEmpty($published);
        $this->assertTrue($published->every->isLive());
    }
}
