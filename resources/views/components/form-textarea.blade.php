{{-- Each component call supplies a field name and label; placeholder and saved value are optional. --}}
@props(['name', 'label', 'placeholder' => '', 'value' => ''])

<div class="mb-5 flex flex-col gap-2">
    <label for="{{ $name }}" class="font-label text-label-s text-ink-soft">{{ $label }}</label>
    {{-- Prefer old input after validation fails; otherwise use the optional saved content. --}}
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        rows="6"
        class="w-full rounded-md border border-rule-strong bg-paper px-3.5 py-2.5 text-body-s text-ink placeholder:text-ink-faint transition-colors duration-200 focus:border-accent-teal focus:outline-none focus-visible:ring-2 focus-visible:ring-accent-teal focus-visible:ring-offset-2 focus-visible:ring-offset-paper"
    >{{ old($name, $value) }}</textarea>
    {{-- The dynamic field name displays the validation error belonging to this textarea. --}}
    @error($name)
        <div class="font-label text-label-s text-accent-coral">{{ $message }}</div>
    @enderror
</div>
