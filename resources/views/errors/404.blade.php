<x-error-page code="404" title="This page could not be found" text="The page you are looking for may have moved, or the address may be incorrect.">
    <x-buttons.primary :href="route('home')">Back to Home</x-buttons.primary>
    <x-buttons.primary :href="route('contact')" variant="ghost">Contact Us</x-buttons.primary>
</x-error-page>
