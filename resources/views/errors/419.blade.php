<x-error-page code="419" title="Your session has expired" text="For your security, forms expire after a period of inactivity. Please reload the form and try again.">
    <x-buttons.primary :href="route('contact')">Contact Form</x-buttons.primary>
    <x-buttons.primary :href="route('inquiry')" variant="ghost">Business Inquiry</x-buttons.primary>
</x-error-page>
