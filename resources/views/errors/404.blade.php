<x-error-page code="404" :title="__('This page could not be found')" :text="__('The page you are looking for may have moved, or the address may be incorrect.')">
    <x-buttons.primary :href="lroute('home')">{{ __('Back to Home') }}</x-buttons.primary>
    <x-buttons.primary :href="lroute('contact')" variant="ghost">{{ __('Contact Us') }}</x-buttons.primary>
</x-error-page>
