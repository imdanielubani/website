<x-legal-page
    title="Cookie Policy"
    description="Information about the cookies and similar technologies used on the AL.GLOBAL OIL SH.A website."
    lead="Which cookies this website uses, why, and how you can manage your preferences."
    updated="2026-10-31"
    :toc="[
        'what' => 'What cookies are',
        'used' => 'Cookies we use',
        'storage' => 'Local storage',
        'third-party' => 'Third-party content',
        'manage' => 'Managing your preferences',
    ]"
>
    @include("pages.legal." . app()->getLocale() . ".cookies")
</x-legal-page>
