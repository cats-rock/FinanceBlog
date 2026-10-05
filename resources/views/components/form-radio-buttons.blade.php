@props(['name', 'label', 'value' => '', 'options'])

<div style="margin-bottom: 1rem;">
    <b>{{ $label }}</b><br>

    {{-- Radio buttons share the same name, allowing only one selected value. --}}
    @foreach ($options as $optionValue => $title)
        <label>
            <input
                name="{{ $name }}"
                type="radio"
                value="{{ $optionValue }}"
                @checked(old($name, $value) == $optionValue)
            >
            {{ $title }}
        </label>
    @endforeach

    @error($name)
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>
