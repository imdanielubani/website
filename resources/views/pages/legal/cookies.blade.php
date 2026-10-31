<x-legal-page
    title="Cookie Policy"
    description="Information about the cookies and similar technologies used on the AL.GLOBAL OIL SH.A website."
    lead="Which cookies this website uses, why, and how you can manage your preferences."
    updated="31 October 2026"
    :toc="[
        'what' => 'What cookies are',
        'used' => 'Cookies we use',
        'storage' => 'Local storage',
        'third-party' => 'Third-party content',
        'manage' => 'Managing your preferences',
    ]"
>
    <h2 id="what">1. What cookies are</h2>
    <p>Cookies are small text files stored on your device by a website. They are widely used to make websites work securely and efficiently.</p>

    <h2 id="used">2. Cookies we use</h2>
    <p>This website currently uses <strong>essential cookies only</strong>. We do not use advertising or tracking cookies.</p>
    <ul>
        <li><strong>Session cookie</strong>: keeps the website working as you move between pages, for example to show form confirmation messages. Expires when your session ends.</li>
        <li><strong>XSRF-TOKEN</strong>: protects our forms against cross-site request forgery. Expires when your session ends.</li>
    </ul>
    <p>If we introduce optional analytics cookies in future, they will only be set with your consent through the cookie settings panel, and this policy will be updated.</p>

    <h2 id="storage">3. Local storage</h2>
    <p>Your cookie preference is stored in your browser’s local storage under the key <code>cookie-consent</code>, so we do not ask you again on every visit. When navigating between pages, a temporary session storage flag is used to display page transitions.</p>

    <h2 id="third-party">4. Third-party content</h2>
    <p>The map on our contact page is provided by Google Maps and is only loaded when you choose to display it. Once loaded, Google may set its own cookies, governed by Google’s privacy policy.</p>

    <h2 id="manage">5. Managing your preferences</h2>
    <p>You can change your choice at any time using the button below or the “Cookie Settings” link in the footer. You can also delete or block cookies in your browser settings; blocking essential cookies may prevent forms from working.</p>
    <p><button type="button" class="btn btn-dark cursor-pointer" x-data x-on:click="$dispatch('open-cookie-settings')"><span>Open cookie settings</span></button></p>
</x-legal-page>
