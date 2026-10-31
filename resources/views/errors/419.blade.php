<x-error-page code="419" title="Your session has expired" text="For your security, forms expire after a period of inactivity. Please go back, refresh the page and try again.">
    <x-buttons.primary :href="url()->previous() !== url()->current() ? url()->previous() : route('contact')">Go Back</x-buttons.primary>
    <x-buttons.primary :href="route('home')" variant="ghost">Home</x-buttons.primary>
</x-error-page>
