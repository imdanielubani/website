<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PagesTest extends TestCase
{
    public static function pages(): array
    {
        return [
            'home' => ['/', 'Reliable Energy. Stronger Partnerships.'],
            'about' => ['/about', 'An Albanian energy company built on trust'],
            'services' => ['/business/products-services', 'Hydrocarbons, fuels, gas and petroleum derivatives'],
            'trading' => ['/business/petroleum-trading', 'Moving energy across borders, reliably'],
            'processing' => ['/business/refining-processing', 'Processing crude oil and its by-products'],
            'infrastructure' => ['/business/infrastructure', 'Rooted in three Albanian locations'],
            'hse' => ['/responsibility/health-safety-environment', 'Everyone goes home safe'],
            'sustainability' => ['/responsibility/sustainability', 'Responsible today, ready for tomorrow'],
            'careers' => ['/careers', 'Build your career in energy'],
            'news' => ['/news', 'Perspectives on energy and our business'],
            'contact' => ['/contact', 'How can we help?'],
            'inquiry' => ['/business-inquiry', 'Start a commercial conversation'],
            'privacy' => ['/privacy-policy', 'Privacy Policy'],
            'cookies' => ['/cookie-policy', 'Cookie Policy'],
            'terms' => ['/terms-and-conditions', 'Terms &amp; Conditions'],
        ];
    }

    #[DataProvider('pages')]
    public function test_page_renders_with_seo_metadata(string $uri, string $heading): void
    {
        $response = $this->get($uri);

        $response->assertOk()
            ->assertSee($heading, false)
            ->assertSee('<meta name="description"', false)
            ->assertSee('<link rel="canonical"', false)
            ->assertSee('property="og:title"', false)
            ->assertSee('name="twitter:card"', false)
            ->assertSee('application/ld+json', false);

        $this->assertSame(1, substr_count($response->getContent(), '<h1'), "Expected exactly one <h1> on {$uri}");
    }

    public function test_pages_are_excluded_from_search_engines(): void
    {
        $directive = 'noindex, nofollow, noarchive, nosnippet, noimageindex';

        $this->get('/')
            ->assertHeader('X-Robots-Tag', $directive)
            ->assertSee('<meta name="robots" content="' . $directive . '">', false);

        // Error responses never reach a route, so the header must be applied globally.
        $this->get('/this-page-does-not-exist')->assertHeader('X-Robots-Tag', $directive);
        $this->get('/news/no-such-article')->assertHeader('X-Robots-Tag', $directive);

        // Files served directly by Apache get the header from public/.htaccess.
        $this->assertStringContainsString('Header set X-Robots-Tag "' . $directive . '"', file_get_contents(public_path('.htaccess')));

        $this->assertStringContainsString('<meta name="robots" content="' . $directive . '">', file_get_contents(resource_path('views/errors/500.blade.php')));
    }

    public function test_robots_txt_lets_search_engines_see_noindex_and_blocks_others(): void
    {
        $robots = file_get_contents(public_path('robots.txt'));

        // Google and Bing must be allowed to fetch pages, or they never see the noindex rule.
        $this->assertMatchesRegularExpression('/User-agent: Googlebot\R(User-agent: .+\R)*Disallow:\s*\R/', $robots);
        $this->assertStringContainsString("User-agent: *\nDisallow: /", str_replace("\r\n", "\n", $robots));
        $this->assertStringNotContainsStringIgnoringCase('sitemap', preg_replace('/^#.*$/m', '', $robots));
    }

    public function test_company_email_is_published(): void
    {
        $email = config('company.contact.email');

        $this->assertSame('info@alglobaloilsha.com', $email);

        $this->get('/contact')
            ->assertSee("mailto:{$email}", false)
            ->assertSee('"email":"' . $email . '"', false)
            ->assertDontSee('Official email to be confirmed');

        $this->get('/business-inquiry')->assertSee("mailto:{$email}", false);
        $this->get('/')->assertSee("mailto:{$email}", false);
    }

    public function test_unknown_page_uses_custom_404(): void
    {
        $this->get('/this-page-does-not-exist')
            ->assertNotFound()
            ->assertSee('This page could not be found');
    }

    public function test_every_configured_image_exists(): void
    {
        foreach (config('images') as $key => $image) {
            foreach (['lg', 'sm'] as $size) {
                $this->assertFileExists(public_path("images/photos/{$image['file']}-{$size}.webp"), "Missing {$size} image for {$key}");
            }

            $this->assertNotEmpty($image['alt'], "Missing alt text for {$key}");
        }
    }
}
