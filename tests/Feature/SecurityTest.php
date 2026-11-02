<?php

namespace Tests\Feature;

use Tests\TestCase;

class SecurityTest extends TestCase
{
    public function test_security_headers_are_sent_on_pages_and_errors(): void
    {
        foreach (['/', '/contact', '/this-page-does-not-exist'] as $uri) {
            $response = $this->get($uri);

            $response->assertHeader('X-Content-Type-Options', 'nosniff')
                ->assertHeader('X-Frame-Options', 'DENY')
                ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
                ->assertHeader('Cross-Origin-Opener-Policy', 'same-origin')
                ->assertHeader('Permissions-Policy')
                ->assertHeader('Content-Security-Policy');
        }
    }

    public function test_content_security_policy_is_strict(): void
    {
        $policy = $this->get('/')->headers->get('Content-Security-Policy');

        $this->assertStringContainsString("default-src 'self'", $policy);
        $this->assertStringContainsString("object-src 'none'", $policy);
        $this->assertStringContainsString("frame-ancestors 'none'", $policy);
        $this->assertStringContainsString("form-action 'self'", $policy);
        $this->assertStringContainsString("base-uri 'self'", $policy);
        $this->assertMatchesRegularExpression("/script-src [^;]*'nonce-[A-Za-z0-9+\/=_-]+'/", $policy);
        $this->assertDoesNotMatchRegularExpression("/script-src [^;]*'unsafe-inline'/", $policy);
    }

    public function test_every_inline_script_carries_the_policy_nonce(): void
    {
        $response = $this->get('/');
        preg_match("/'nonce-([^']+)'/", $response->headers->get('Content-Security-Policy'), $match);
        $nonce = $match[1];

        preg_match_all('/<script\b([^>]*)>/i', $response->getContent(), $scripts);

        foreach ($scripts[1] as $attributes) {
            if (str_contains($attributes, 'application/ld+json')) {
                continue; // Data block, never executed.
            }

            $this->assertStringContainsString('nonce="' . $nonce . '"', $attributes, "Script without nonce: <script{$attributes}>");
        }
    }

    public function test_nonce_changes_on_every_request(): void
    {
        $first = $this->get('/')->headers->get('Content-Security-Policy');
        $second = $this->get('/')->headers->get('Content-Security-Policy');

        $this->assertNotSame($first, $second);
    }

    public function test_hsts_is_only_sent_over_https(): void
    {
        $this->get('/')->assertHeaderMissing('Strict-Transport-Security');
        $this->get('https://localhost/')->assertHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
    }

    public function test_forms_are_csrf_protected(): void
    {
        // Laravel skips CSRF checks during tests, so verify the wiring instead.
        $webGroup = app(\Illuminate\Contracts\Http\Kernel::class)->getMiddlewareGroups()['web'];
        $this->assertContains(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class, $webGroup);
        $this->assertContains(\Illuminate\Routing\Middleware\ThrottleRequests::class . ':site', $webGroup);

        foreach (['contact.submit', 'inquiry.submit'] as $name) {
            $this->assertContains('web', app('router')->getRoutes()->getByName($name)->middleware());
        }

        $this->get(route('contact'))->assertSee('name="_token"', false);
        $this->get(route('inquiry'))->assertSee('name="_token"', false);
    }

    public function test_session_expired_page_does_not_link_to_external_sites(): void
    {
        \Illuminate\Support\Facades\Route::middleware('web')->get('/_expired', fn () => abort(419));

        $this->get('/_expired', ['Referer' => 'https://attacker.example/phish'])
            ->assertStatus(419)
            ->assertSee('Your session has expired')
            ->assertDontSee('attacker.example');
    }

    public function test_user_input_is_escaped(): void
    {
        $this->get(route('contact', ['type' => '"><script>alert(1)</script>']))
            ->assertOk()
            ->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_private_project_files_are_blocked_by_root_htaccess(): void
    {
        $rules = file_get_contents(base_path('.htaccess'));

        $this->assertStringContainsString('RewriteRule ^public(/|$) - [L]', $rules);
        $this->assertStringContainsString('RewriteRule ^ - [F,L]', $rules);
        $this->assertStringContainsString('Options -Indexes', file_get_contents(public_path('.htaccess')));
    }

}
