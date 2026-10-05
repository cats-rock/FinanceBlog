@props(['name', 'label', 'value' => '', 'options'])

<div class="mb-5 flex flex-col gap-2">
    <label for="{{ $name }}" class="font-label text-label-s text-ink-soft">{{ $label }}</label>

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        class="w-full rounded-md border border-rule-strong bg-paper px-3.5 py-2.5 text-body-s text-ink transition-colors duration-200 focus:border-accent-teal focus:outline-none focus-visible:ring-2 focus-visible:ring-accent-teal focus-visible:ring-offset-2 focus-visible:ring-offset-paper"
    >
        {{-- Build one dropdown option from every supplied ID and title. --}}
        @foreach ($options as $optionValue => $title)
            <option
                value="{{ $optionValue }}"
                @selected(old($name, $value) == $optionValue)
            >
                {{ $title }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="font-label text-label-s text-accent-coral">{{ $message }}</div>
    @enderror
</div>
