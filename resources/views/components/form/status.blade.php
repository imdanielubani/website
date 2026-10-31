{{-- Success and error summaries for inquiry forms. --}}
@if (session('status'))
    <div role="status" class="mb-10 flex gap-4 bg-ink-2 p-6 text-white" tabindex="-1" data-form-status>
        <span class="grid size-10 shrink-0 place-items-center bg-accent text-ink">
            <svg viewBox="0 0 16 16" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m3 8.5 3 3 7-7" /></svg>
        </span>
        <div>
            <p class="font-semibold">{{ __('Message sent') }}</p>
            <p class="mt-1 text-white/70">{{ __(session('status')) }}</p>
        </div>
    </div>
@endif

@if ($errors->any())
    <div role="alert" class="mb-10 border-l-2 border-red-700 bg-red-50 p-6 text-red-900" tabindex="-1" data-form-status>
        <p class="font-semibold">{{ __('Please check the highlighted fields') }}</p>
        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
