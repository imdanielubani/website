<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Localisation helpers
|--------------------------------------------------------------------------
|
| Routes are registered once per language. The default language uses the
| plain route names (e.g. "about"); other languages are prefixed with their
| code (e.g. "sq.about"). These helpers keep templates language-agnostic.
|
*/

if (! function_exists('localized_route_name')) {
    function localized_route_name(string $name, ?string $locale = null): string
    {
        $locale ??= app()->getLocale();

        return $locale === config('site.default_locale') ? $name : "{$locale}.{$name}";
    }
}

if (! function_exists('lroute')) {
    /**
     * URL of a named route in the current (or given) language.
     */
    function lroute(string $name, mixed $parameters = [], bool $absolute = true, ?string $locale = null): string
    {
        return route(localized_route_name($name, $locale), $parameters, $absolute);
    }
}

if (! function_exists('base_route_name')) {
    /**
     * Route name without its language prefix ("sq.about" becomes "about").
     */
    function base_route_name(?string $name = null): ?string
    {
        $name ??= Route::currentRouteName();

        if ($name === null) {
            return null;
        }

        foreach (array_keys(config('site.locales')) as $locale) {
            if (str_starts_with($name, "{$locale}.")) {
                return substr($name, strlen($locale) + 1);
            }
        }

        return $name;
    }
}

if (! function_exists('route_is')) {
    /**
     * Whether the current route matches any pattern, in any language.
     */
    function route_is(string ...$patterns): bool
    {
        $current = base_route_name();

        if ($current === null) {
            return false;
        }

        foreach ($patterns as $pattern) {
            if (\Illuminate\Support\Str::is($pattern, $current)) {
                return true;
            }
        }

        return false;
    }
}

if (! function_exists('locale_switch_url')) {
    /**
     * The current page in another language, falling back to that
     * language's home page (e.g. on error pages).
     */
    function locale_switch_url(string $locale): string
    {
        $route = request()->route();
        $base = base_route_name();

        if ($route && $base && Route::has(localized_route_name($base, $locale))) {
            $url = lroute($base, $route->parameters(), true, $locale);
            $query = request()->getQueryString();

            return $query ? "{$url}?{$query}" : $url;
        }

        return lroute('home', [], true, $locale);
    }
}

if (! function_exists('t')) {
    /**
     * Translate a plain-text value passed to a component (prop or slot).
     * HTML entities are decoded first so "News &amp; Insights" and
     * "News & Insights" resolve to the same translation key. Text that has
     * no translation, or is already translated, is returned unchanged.
     */
    function t(mixed $text): string
    {
        $text = html_entity_decode(trim((string) $text), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return $text === '' ? '' : (string) __($text);
    }
}
