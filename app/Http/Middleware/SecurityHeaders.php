<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;

/**
 * Adds a Content Security Policy and other protective headers to every
 * Laravel response.
 *
 * Scripts may only come from this site, and inline scripts must carry the
 * per-request nonce (Vite adds it to the bundles automatically). Alpine.js
 * evaluates its attribute expressions with the Function constructor, which
 * is why 'unsafe-eval' is allowed; all template output is escaped by Blade,
 * so no untrusted markup can reach the page.
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $nonce = Vite::useCspNonce();

        $response = $next($request);

        $response->headers->set('Content-Security-Policy', $this->policy($nonce, $request));
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'accelerometer=(), autoplay=(), camera=(), display-capture=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=(), browsing-topics=()');
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        $response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');

        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        $response->headers->remove('X-Powered-By');
        if (! headers_sent()) {
            header_remove('X-Powered-By');
        }

        return $response;
    }

    private function policy(string $nonce, Request $request): string
    {
        // During development the Vite dev server serves assets and hot reloads.
        $dev = [];
        if (Vite::isRunningHot()) {
            $origin = rtrim(file_get_contents(public_path('hot')));
            $dev = [$origin, preg_replace('#^http#', 'ws', $origin)];
        }

        $directives = [
            'default-src' => ["'self'"],
            'script-src' => ["'self'", "'nonce-{$nonce}'", "'unsafe-eval'", ...$dev],
            'style-src' => ["'self'", "'unsafe-inline'", ...$dev],
            'img-src' => ["'self'", 'data:', ...$dev],
            'font-src' => ["'self'", ...$dev],
            'connect-src' => ["'self'", ...$dev],
            'frame-src' => ['https://www.google.com', 'https://maps.google.com'],
            'form-action' => ["'self'"],
            'base-uri' => ["'self'"],
            'object-src' => ["'none'"],
            'frame-ancestors' => ["'none'"],
            'manifest-src' => ["'self'"],
            'worker-src' => ["'none'"],
        ];

        $policy = collect($directives)
            ->map(fn (array $sources, string $name) => $name . ' ' . implode(' ', $sources))
            ->implode('; ');

        return $request->isSecure() ? $policy . '; upgrade-insecure-requests' : $policy;
    }
}
