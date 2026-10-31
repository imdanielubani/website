@php
    $email = config('company.contact.email');
    $contactLine = $email ? "by email at {$email}" : 'through the contact form on this website';
@endphp

<x-legal-page
    title="Privacy Policy"
    description="How AL.GLOBAL OIL SH.A collects, uses and protects personal data submitted through this website."
    lead="How we collect, use and protect personal information when you use this website or contact us."
    updated="31 October 2026"
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
    <h2 id="controller">1. Who we are</h2>
    <p>This website is operated by <strong>{{ config('company.name') }}</strong> (NUIS {{ config('company.nuis') }}), a joint-stock company registered in Albania with its registered seat at {{ implode(', ', config('company.locations.tirana.lines')) }}. We are responsible for the personal data processed through this website.</p>

    <h2 id="data">2. Information we collect</h2>
    <p>We collect only the information needed to operate this website and respond to you:</p>
    <ul>
        <li><strong>Contact and inquiry forms:</strong> your name, company name, email address, telephone number, country, inquiry type, product requirements, estimated quantities and the content of your message.</li>
        <li><strong>Career applications:</strong> information you choose to share about your experience and availability, and any CV you send at our request.</li>
        <li><strong>Technical data:</strong> standard server logs such as IP address, browser type and the pages requested, used for security and to keep the website working.</li>
        <li><strong>Cookies:</strong> essential cookies described in our <a href="{{ route('legal.cookies') }}">Cookie Policy</a>.</li>
    </ul>

    <h2 id="use">3. How we use information</h2>
    <ul>
        <li>To respond to your inquiry and, where relevant, to discuss a commercial relationship.</li>
        <li>To assess job applications.</li>
        <li>To protect the website against misuse, including spam and abuse of our forms.</li>
        <li>To comply with legal obligations.</li>
    </ul>
    <p>We do not sell personal data and we do not use it for automated decision-making.</p>

    <h2 id="legal-basis">4. Legal basis</h2>
    <p>We process personal data on the basis of your consent (given when you submit a form), steps taken at your request before entering into a contract, our legitimate interests in operating and securing this website and responding to business correspondence, and compliance with legal obligations.</p>

    <h2 id="sharing">5. Sharing information</h2>
    <p>Personal data is accessed only by personnel who need it to handle your request. We may share it with service providers who host this website or deliver email on our behalf, under appropriate confidentiality obligations, or where required by law.</p>

    <h2 id="retention">6. Retention</h2>
    <p>We keep inquiry records for as long as needed to respond and to manage any resulting business relationship, and then delete them unless a longer period is required by law. Unsuccessful job applications are retained only for as long as needed for future opportunities, unless you ask us to delete them sooner.</p>

    <h2 id="security">7. Security</h2>
    <p>We use appropriate technical and organisational measures to protect personal data, including encrypted connections, protection against automated form abuse and restricted access to submitted information.</p>

    <h2 id="rights">8. Your rights</h2>
    <p>Subject to applicable law, you may request access to, correction or deletion of your personal data, object to or restrict its processing, and withdraw consent at any time. You may also lodge a complaint with the Albanian Information and Data Protection Commissioner. To exercise your rights, contact us {{ $contactLine }} or write to our registered address.</p>

    <h2 id="changes">9. Changes to this policy</h2>
    <p>We may update this policy from time to time. The date at the top of this page shows when it was last revised.</p>
</x-legal-page>
