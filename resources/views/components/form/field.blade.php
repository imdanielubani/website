@props([
    'name',
    'label',
    'type' => 'text',
    'required' => false,
    'options' => null,   // value => label, renders a <select>
    'selected' => null,
    'rows' => 5,
    'hint' => null,
])

@php
    $id = 'f-' . $name;
    $hasError = $errors->has($name);
    $describedBy = trim(($hint ? "{$id}-hint " : '') . ($hasError ? "{$id}-error" : ''));
@endphp

<div {{ $attributes->only('class') }}>
    <label for="{{ $id }}" class="field-label">
        {{ $label }}
        @if ($required)
            <span class="text-olive" aria-hidden="true">*</span>
        @else
            <span class="font-normal text-stone">(optional)</span>
        @endif
    </label>

    @if ($options)
        <select id="{{ $id }}" name="{{ $name }}" class="field" @required($required) @if ($hasError) aria-invalid="true" @endif @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif>
            @foreach ($options as $value => $text)
                <option value="{{ $value }}" @selected(old($name, $selected) === $value)>{{ $text }}</option>
            @endforeach
        </select>
    @elseif ($type === 'textarea')
        <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" class="field resize-y" @required($required) @if ($hasError) aria-invalid="true" @endif @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif {{ $attributes->except('class') }}>{{ old($name) }}</textarea>
    @else
        <input id="{{ $id }}" type="{{ $type }}" name="{{ $name }}" value="{{ old($name) }}" class="field" @required($required) @if ($hasError) aria-invalid="true" @endif @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif {{ $attributes->except('class') }}>
    @endif

    @if ($hint)
        <p id="{{ $id }}-hint" class="mt-2 text-sm text-stone">{{ $hint }}</p>
    @endif

    @error($name)
        <p id="{{ $id }}-error" class="field-error">{{ $message }}</p>
    @enderror
</div>
