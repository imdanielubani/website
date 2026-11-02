<x-legal-page
    title="Privacy Policy"
    description="How AL.GLOBAL OIL SH.A collects, uses and protects personal data submitted through this website."
    lead="How we collect, use and protect personal information when you use this website or contact us."
    updated="2025-03-05"
    :toc="[
        'controller' => 'Who we are',
        'data' => 'Information we collect',
        'use' => 'How we use information',
        'legal-basis' => 'Legal basis',
        'sharing' => 'Sharing information',
        'retention' => 'Retention',
        'security' => 'Security',
        'rights' => 'Your rights',
        'changes' => 'Changes to this policy',
    ]"
>
    @include("pages.legal." . app()->getLocale() . ".privacy")
</x-legal-page>
