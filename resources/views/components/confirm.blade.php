{{-- Marks content that is a placeholder awaiting confirmation from the company. --}}
<span {{ $attributes->class(['confirm-flag']) }}>
    <svg viewBox="0 0 16 16" class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="8" cy="8" r="6.25" /><path d="M8 5v3.5M8 11v.01" /></svg>
    {{ $slot->isEmpty() ? __('To be confirmed by the company') : t($slot) }}
</span>
