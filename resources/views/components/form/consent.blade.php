<div>
    <label class="flex cursor-pointer items-start gap-3 text-sm leading-relaxed text-stone">
        <input type="checkbox" name="consent" value="1" required @checked(old('consent')) class="mt-1 size-4 shrink-0 cursor-pointer accent-[#1b1b19]" @error('consent') aria-invalid="true" aria-describedby="f-consent-error" @enderror>
        <span>I agree that AL.GLOBAL OIL may use the details in this form to respond to my inquiry, as described in the <a href="{{ route('legal.privacy') }}" class="font-medium text-ink-2 underline underline-offset-4">Privacy Policy</a>. <span class="text-olive" aria-hidden="true">*</span></span>
    </label>
    @error('consent')
        <p id="f-consent-error" class="field-error">{{ $message }}</p>
    @enderror
</div>

{{-- Honeypot: hidden from people and assistive technology, tempting to bots. --}}
<div class="absolute -left-[9999px] h-px w-px overflow-hidden" aria-hidden="true">
    <label for="f-website">Website</label>
    <input id="f-website" type="text" name="website" tabindex="-1" autocomplete="off">
</div>
