{{--
    Cookie consent. The site currently sets only essential cookies (session and
    CSRF protection). Preferences are stored in localStorage under
    "cookie-consent" and announced with a "cookie-consent-updated" window event
    so optional analytics can be wired in later without changing this UI.
--}}
<div
    x-data="cookieConsent"
    x-on:open-cookie-settings.window="openSettings()"
    x-cloak
    x-show="visible"
    x-transition:enter="transition duration-700 ease-out-expo"
    x-transition:enter-start="opacity-0 translate-y-6"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition duration-300 ease-in"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 translate-y-6"
    class="on-dark fixed inset-x-3 bottom-3 z-[90] text-white sm:inset-x-auto sm:right-6 sm:bottom-6 sm:max-w-md"
    role="region"
    aria-label="{{ __('Cookie preferences') }}"
>
    <div class="bg-ink-2 p-6 shadow-2xl ring-1 ring-white/10 sm:p-7">
        <p class="font-display text-lg font-semibold tracking-[-0.02em]">{{ __('Your privacy') }}</p>
        <p class="mt-2 text-sm leading-relaxed text-white/65">
            {{ __('We use essential cookies to keep this website secure and working. We do not use advertising cookies.') }}
            {!! __('Read our :link.', ['link' => '<a href="' . e(lroute('legal.cookies')) . '" class="text-white underline decoration-accent underline-offset-4">' . e(__('Cookie Policy (link)')) . '</a>']) !!}
        </p>

        <div x-show="settings" x-collapse class="mt-5 space-y-3">
            <label class="flex items-start justify-between gap-4 border-t border-white/10 pt-4 text-sm">
                <span>
                    <span class="block font-semibold">{{ __('Essential') }}</span>
                    <span class="text-white/55">{{ __('Security and session cookies. Always active.') }}</span>
                </span>
                <input type="checkbox" checked disabled class="mt-1 size-4 accent-[#e2e890]">
            </label>
            <label class="flex cursor-pointer items-start justify-between gap-4 border-t border-white/10 pt-4 text-sm">
                <span>
                    <span class="block font-semibold">{{ __('Analytics') }}</span>
                    <span class="text-white/55">{{ __('Anonymous usage statistics, only if enabled in future.') }}</span>
                </span>
                <input type="checkbox" x-model="analytics" class="mt-1 size-4 cursor-pointer accent-[#e2e890]">
            </label>
        </div>

        <div class="mt-6 flex flex-wrap gap-2">
            <button type="button" x-on:click="acceptAll()" class="min-h-11 cursor-pointer bg-accent px-5 text-sm font-semibold text-ink transition-colors hover:bg-white">{{ __('Accept all') }}</button>
            <button type="button" x-on:click="essentialOnly()" class="min-h-11 cursor-pointer px-5 text-sm font-semibold ring-1 ring-white/25 transition-colors ring-inset hover:bg-white/10">{{ __('Essential only') }}</button>
            <button type="button" x-show="!settings" x-on:click="settings = true" class="min-h-11 cursor-pointer px-3 text-sm font-medium text-white/70 underline underline-offset-4 hover:text-white">{{ __('Settings') }}</button>
            <button type="button" x-show="settings" x-on:click="save()" class="min-h-11 cursor-pointer px-3 text-sm font-medium text-white/70 underline underline-offset-4 hover:text-white">{{ __('Save choices') }}</button>
        </div>
    </div>
</div>
