<x-error-page code="419" :title="__('Your session has expired')" :text="__('For your security, forms expire after a period of inactivity. Please reload the form and try again.')">
    <x-buttons.primary :href="lroute('contact')">{{ __('Contact Form') }}</x-buttons.primary>
    <x-buttons.primary :href="lroute('inquiry')" variant="ghost">{{ __('Business Inquiry') }}</x-buttons.primary>
</x-error-page>
