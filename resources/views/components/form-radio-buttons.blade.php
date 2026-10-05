@props(['name', 'label', 'value' => '', 'options'])

<fieldset class="mb-5 flex flex-col gap-2">
    <legend class="font-label text-label-s text-ink-soft">{{ $label }}</legend>

    {{-- Radio buttons share the same name, allowing only one selected value. --}}
    <div class="flex flex-wrap gap-x-5 gap-y-2">
        @foreach ($options as $optionValue => $title)
            <label for="{{ $name }}-{{ $optionValue }}" class="flex items-center gap-2 text-body-s text-ink">
                <input
                    id="{{ $name }}-{{ $optionValue }}"
                    name="{{ $name }}"
                    type="radio"
                    value="{{ $optionValue }}"
                    @checked(old($name, $value) == $optionValue)
                    class="size-4 rounded-full border border-rule-strong text-accent-teal focus:outline-none focus-visible:ring-2 focus-visible:ring-accent-teal focus-visible:ring-offset-2 focus-visible:ring-offset-paper"
                >
                {{ $title }}
            </label>
        @endforeach
    </div>

    @error($name)
        <div class="font-label text-label-s text-accent-coral">{{ $message }}</div>
    @enderror
</fieldset>
