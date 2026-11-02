<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Search engine visibility
    |--------------------------------------------------------------------------
    |
    | When true, every response carries an X-Robots-Tag header, every page
    | renders a "noindex, nofollow" meta tag and robots.txt disallows all
    | crawlers. Set SITE_NOINDEX=false (and update public/robots.txt) when
    | the site is ready to be indexed.
    |
    */

    'noindex' => (bool) env('SITE_NOINDEX', true),

    /*
    |--------------------------------------------------------------------------
    | Inquiry recipient
    |--------------------------------------------------------------------------
    |
    | Contact and business inquiry submissions are emailed to this address.
    |
    */

    'inquiry_recipient' => env('INQUIRY_RECIPIENT', 'info@alglobaloilsha.com'),

    /*
    |--------------------------------------------------------------------------
    | Confirmation email to visitors
    |--------------------------------------------------------------------------
    |
    | When true, visitors receive a branded confirmation email in their
    | language after submitting a form.
    |
    */

    'send_acknowledgement' => (bool) env('INQUIRY_SEND_ACKNOWLEDGEMENT', true),

    /*
    |--------------------------------------------------------------------------
    | Languages
    |--------------------------------------------------------------------------
    |
    | The default language is served without a URL prefix (/about); every
    | other language lives under its code (/sq/about). Translations are in
    | lang/{code}.json and lang/{code}/*.php.
    |
    */

    'default_locale' => 'en',

    'locales' => [
        'en' => ['name' => 'English', 'short' => 'EN', 'og' => 'en_GB'],
        'sq' => ['name' => 'Shqip', 'short' => 'SQ', 'og' => 'sq_AL'],
    ],

];
