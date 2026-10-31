<?php

namespace Tests\Feature;

use App\Mail\InquiryReceived;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    public static function albanianPages(): array
    {
        return [
            'home' => ['/sq', 'Energji e Besueshme. Partneritete më të Forta.'],
            'about' => ['/sq/about', 'Një shoqëri shqiptare energjie e ndërtuar mbi besimin'],
            'services' => ['/sq/business/products-services', 'Hidrokarbure, karburante, gaz dhe derivate nafte'],
            'trading' => ['/sq/business/petroleum-trading', 'Lëvizim energjinë përtej kufijve, me besueshmëri'],
            'processing' => ['/sq/business/refining-processing', 'Përpunimi i naftës bruto dhe nënprodukteve të saj'],
            'infrastructure' => ['/sq/business/infrastructure', 'Të rrënjosur në tre vendndodhje në Shqipëri'],
            'hse' => ['/sq/responsibility/health-safety-environment', 'Të gjithë kthehen shëndoshë në shtëpi'],
            'sustainability' => ['/sq/responsibility/sustainability', 'Të përgjegjshëm sot, të gatshëm për nesër'],
            'careers' => ['/sq/careers', 'Ndërtoni karrierën tuaj në energji'],
            'news' => ['/sq/news', 'Këndvështrime mbi energjinë dhe biznesin tonë'],
            'contact' => ['/sq/contact', 'Si mund t’ju ndihmojmë?'],
            'inquiry' => ['/sq/business-inquiry', 'Filloni një bisedë tregtare'],
            'privacy' => ['/sq/privacy-policy', 'Kush jemi'],
            'cookies' => ['/sq/cookie-policy', 'Çfarë janë cookies'],
            'terms' => ['/sq/terms-and-conditions', 'Rreth këtyre kushteve'],
        ];
    }

    #[DataProvider('albanianPages')]
    public function test_albanian_page_renders_in_albanian(string $uri, string $text): void
    {
        $this->get($uri)
            ->assertOk()
            ->assertHeader('Content-Language', 'sq')
            ->assertSee('<html lang="sq"', false)
            ->assertSee('content="sq_AL"', false)
            ->assertSee($text, false)
            ->assertSee('Kreu')
            ->assertDontSee('Skip to content');
    }

    public function test_english_remains_the_default_without_prefix(): void
    {
        $this->get('/about')
            ->assertOk()
            ->assertHeader('Content-Language', 'en')
            ->assertSee('<html lang="en"', false)
            ->assertSee('An Albanian energy company built on trust');
    }

    public function test_language_switcher_links_to_the_same_page(): void
    {
        $this->get('/business/petroleum-trading')
            ->assertSee('href="' . url('/sq/business/petroleum-trading') . '"', false)
            ->assertSee('hreflang="sq"', false);

        $this->get('/sq/news/how-to-start-a-business-inquiry')
            ->assertSee('href="' . url('/news/how-to-start-a-business-inquiry') . '"', false);

        $this->get('/contact?type=careers')
            ->assertSee('href="' . url('/sq/contact') . '?type=careers"', false);
    }

    public function test_alternate_language_links_are_declared(): void
    {
        $this->get('/sq/about')
            ->assertSee('<link rel="alternate" hreflang="en" href="' . url('/about') . '">', false)
            ->assertSee('<link rel="alternate" hreflang="sq" href="' . url('/sq/about') . '">', false)
            ->assertSee('<link rel="alternate" hreflang="x-default" href="' . url('/about') . '">', false);
    }

    public function test_internal_links_stay_in_the_current_language(): void
    {
        $html = $this->get('/sq')->getContent();

        $this->assertStringContainsString('href="' . url('/sq/about') . '"', $html);
        $this->assertStringContainsString('href="' . url('/sq/contact') . '"', $html);
        $this->assertStringNotContainsString('href="' . url('/about') . '" class="nav-link', $html);
    }

    public function test_news_articles_are_translated(): void
    {
        $this->get('/sq/news/understanding-the-petroleum-products-supply-chain')
            ->assertOk()
            ->assertSee('Të kuptosh zinxhirin e furnizimit me produkte nafte')
            ->assertSee('"inLanguage":"sq"', false);
    }

    public function test_albanian_error_page(): void
    {
        $this->get('/sq/no-such-page')
            ->assertNotFound()
            ->assertSee('Kjo faqe nuk u gjet');
    }

    public function test_albanian_form_shows_albanian_validation_and_redirects_back_in_albanian(): void
    {
        Mail::fake();
        $this->withoutMiddleware(ValidateCsrfToken::class);

        $this->from('/sq/contact')
            ->post('/sq/contact', ['form_started' => Crypt::encryptString((string) (time() - 30))])
            ->assertRedirect('/sq/contact')
            ->assertSessionHasErrors(['full_name' => 'Fusha emri i plotë është e detyrueshme.']);

        $this->post('/sq/contact', [
            'full_name' => 'Arta Hoxha',
            'email' => 'arta@example.com',
            'country' => 'Shqipëri',
            'inquiry_type' => 'general',
            'message' => 'Dëshirojmë të diskutojmë furnizimin.',
            'consent' => '1',
            'form_started' => Crypt::encryptString((string) (time() - 30)),
        ])->assertRedirect(url('/sq/contact') . '#contact-form');

        Mail::assertSent(InquiryReceived::class, fn (InquiryReceived $mail) => $mail->fields['Language'] === 'Shqip');
    }

    public function test_every_translation_placeholder_is_preserved(): void
    {
        $translations = json_decode(file_get_contents(lang_path('sq.json')), true);

        $this->assertIsArray($translations);

        foreach ($translations as $english => $albanian) {
            preg_match_all('/:[a-z_]+/', $english, $expected);
            preg_match_all('/:[a-z_]+/', $albanian, $actual);
            sort($expected[0]);
            sort($actual[0]);

            $this->assertSame($expected[0], $actual[0], "Placeholder mismatch in: {$english}");
        }
    }

    public function test_home_screen_icons_are_published(): void
    {
        foreach (['apple-touch-icon.png' => 180, 'icon-192.png' => 192, 'icon-512.png' => 512, 'icon-maskable-512.png' => 512] as $file => $size) {
            $this->assertFileExists(public_path($file));
            [$width, $height] = getimagesize(public_path($file));
            $this->assertSame([$size, $size], [$width, $height], $file);
        }

        $this->assertFileExists(public_path('favicon.ico'));
        $this->assertJson(file_get_contents(public_path('site.webmanifest')));

        $this->get('/')
            ->assertSee('<link rel="apple-touch-icon" href="' . asset('apple-touch-icon.png') . '">', false)
            ->assertSee('<link rel="manifest" href="' . asset('site.webmanifest') . '">', false);
    }
}
