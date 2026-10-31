<?php

/*
|--------------------------------------------------------------------------
| Validation messages (Albanian)
|--------------------------------------------------------------------------
|
| Messages for the rules used by the site's forms. Rules not listed here
| fall back to Laravel's English messages.
|
*/

return [

    'accepted' => 'Fusha :attribute duhet të pranohet.',
    'email' => 'Fusha :attribute duhet të jetë një adresë email e vlefshme.',
    'in' => 'Vlera e zgjedhur për :attribute nuk është e vlefshme.',
    'max' => [
        'string' => 'Fusha :attribute nuk mund të ketë më shumë se :max karaktere.',
        'numeric' => 'Fusha :attribute nuk mund të jetë më e madhe se :max.',
        'array' => 'Fusha :attribute nuk mund të ketë më shumë se :max elemente.',
        'file' => 'Fusha :attribute nuk mund të jetë më e madhe se :max kilobajt.',
    ],
    'min' => [
        'string' => 'Fusha :attribute duhet të ketë të paktën :min karaktere.',
        'numeric' => 'Fusha :attribute duhet të jetë të paktën :min.',
        'array' => 'Fusha :attribute duhet të ketë të paktën :min elemente.',
        'file' => 'Fusha :attribute duhet të jetë të paktën :min kilobajt.',
    ],
    'regex' => 'Formati i fushës :attribute nuk është i vlefshëm.',
    'required' => 'Fusha :attribute është e detyrueshme.',
    'string' => 'Fusha :attribute duhet të jetë tekst.',

    'attributes' => [
        'full_name' => 'emri i plotë',
        'company_name' => 'emri i kompanisë',
        'contact_person' => 'personi i kontaktit',
        'email' => 'email',
        'phone' => 'telefoni',
        'country' => 'shteti',
        'inquiry_type' => 'lloji i kërkesës',
        'product_requirements' => 'kërkesat për produktet',
        'estimated_quantity' => 'sasia e vlerësuar',
        'message' => 'mesazhi',
        'consent' => 'pëlqimi',
        'website' => 'faqja e internetit',
        'form_started' => 'formulari',
    ],

];
