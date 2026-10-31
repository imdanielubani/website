<?php

namespace App\Providers;

use App\Content\NewsRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NewsRepository::class, fn () => new NewsRepository(resource_path('content/news.php')));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Contact and inquiry forms: a few submissions per minute, capped hourly.
        RateLimiter::for('inquiries', fn (Request $request) => [
            Limit::perMinute(3)->by($request->ip()),
            Limit::perHour(15)->by($request->ip()),
        ]);

        // Every page: generous for people, limiting for scrapers and floods.
        RateLimiter::for('site', fn (Request $request) => Limit::perMinute(120)->by($request->ip()));

        // Never expose stack traces or configuration on the live site, even
        // if APP_DEBUG is accidentally left on.
        if ($this->app->isProduction() && config('app.debug')) {
            config(['app.debug' => false]);
            Log::warning('APP_DEBUG was enabled in production and has been forced off.');
        }
    }
}
