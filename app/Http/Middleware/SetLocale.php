<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

/**
 * Sets the language from the first URL segment (/sq/...). Registered
 * globally so that error pages under a language prefix are translated too.
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $segment = $request->segment(1);
        $locales = array_keys(config('site.locales'));

        $locale = in_array($segment, $locales, true) ? $segment : config('site.default_locale');

        app()->setLocale($locale);
        Carbon::setLocale($locale);

        $response = $next($request);
        $response->headers->set('Content-Language', $locale);

        return $response;
    }
}
