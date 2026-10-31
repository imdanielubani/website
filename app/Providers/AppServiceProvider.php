<?php

namespace App\Providers;

use App\Content\NewsRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
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
    }
}
