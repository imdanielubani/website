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

    'inquiry_recipient' => env('INQUIRY_RECIPIENT', 'info@example.com'),

];
