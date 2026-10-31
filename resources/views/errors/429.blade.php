<x-error-page code="429" :title="__('Too many requests')" :text="__('We have received several submissions from your connection in a short time. Please wait a few minutes before trying again, or email us directly.')">
    <x-buttons.primary :href="lroute('home')">{{ __('Back to Home') }}</x-buttons.primary>
    {{-- Phone numbers hidden for now. Remove this comment to show them again.
    <x-buttons.primary :href="'tel:' . preg_replace('/\s+/', '', config('company.contact.phones')[0])" variant="ghost">{{ __('Call :phone', ['phone' => config('company.contact.phones')[0]]) }}</x-buttons.primary>
    --}}
    <x-buttons.primary :href="'mailto:' . config('company.contact.email')" variant="ghost">{{ config('company.contact.email') }}</x-buttons.primary>
</x-error-page>
