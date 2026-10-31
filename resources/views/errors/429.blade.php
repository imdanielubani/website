<x-error-page code="429" title="Too many requests" text="We have received several submissions from your connection in a short time. Please wait a few minutes before trying again, or call us directly.">
    <x-buttons.primary :href="route('home')">Back to Home</x-buttons.primary>
    <x-buttons.primary :href="'tel:' . preg_replace('/\s+/', '', config('company.contact.phones')[0])" variant="ghost">Call {{ config('company.contact.phones')[0] }}</x-buttons.primary>
</x-error-page>
