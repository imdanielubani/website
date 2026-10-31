<x-legal-page
    title="Terms & Conditions"
    description="Terms and conditions governing the use of the AL.GLOBAL OIL SH.A website."
    lead="The terms that apply when you access and use this website."
    updated="2026-10-31"
    :toc="[
        'about' => 'About these terms',
        'information' => 'Website information',
        'no-offer' => 'No offer or contract',
        'ip' => 'Intellectual property',
        'use' => 'Acceptable use',
        'links' => 'External links',
        'liability' => 'Limitation of liability',
        'law' => 'Governing law',
    ]"
>
    @include("pages.legal." . app()->getLocale() . ".terms")
</x-legal-page>
