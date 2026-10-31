<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Site routes, registered once per language
|--------------------------------------------------------------------------
|
| The default language (English) is served without a prefix: /about.
| Other languages use their code as prefix and route-name prefix:
| /sq/about is named "sq.about". Use lroute('about') in templates to link
| to the current language. The active language is set by SetLocale.
|
*/

$site = function () {
    Route::get('/', HomeController::class)->name('home');

    Route::controller(PageController::class)->group(function () {
        Route::get('/about', 'about')->name('about');

        Route::prefix('business')->group(function () {
            Route::get('/products-services', 'services')->name('services');
            Route::get('/petroleum-trading', 'trading')->name('trading');
            Route::get('/refining-processing', 'processing')->name('processing');
            Route::get('/infrastructure', 'infrastructure')->name('infrastructure');
        });

        Route::prefix('responsibility')->group(function () {
            Route::get('/health-safety-environment', 'hse')->name('hse');
            Route::get('/sustainability', 'sustainability')->name('sustainability');
        });

        Route::get('/careers', 'careers')->name('careers');

        Route::get('/privacy-policy', 'privacy')->name('legal.privacy');
        Route::get('/cookie-policy', 'cookies')->name('legal.cookies');
        Route::get('/terms-and-conditions', 'terms')->name('legal.terms');
    });

    Route::controller(NewsController::class)->prefix('news')->name('news.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/category/{category}', 'category')->name('category');
        Route::get('/{slug}', 'show')->name('show');
    });

    Route::get('/contact', [ContactController::class, 'show'])->name('contact');
    Route::post('/contact', [ContactController::class, 'submit'])
        ->middleware('throttle:inquiries')
        ->name('contact.submit');

    Route::get('/business-inquiry', [InquiryController::class, 'show'])->name('inquiry');
    Route::post('/business-inquiry', [InquiryController::class, 'submit'])
        ->middleware('throttle:inquiries')
        ->name('inquiry.submit');
};

Route::group([], $site);

foreach (array_keys(config('site.locales')) as $locale) {
    if ($locale !== config('site.default_locale')) {
        Route::prefix($locale)->name("{$locale}.")->group($site);
    }
}
