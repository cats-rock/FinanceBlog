@props(['name', 'label', 'value' => '', 'options'])

<div style="margin-bottom: 1rem;">
    <label for="{{ $name }}"><b>{{ $label }}</b></label><br>

    <select id="{{ $name }}" name="{{ $name }}">
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
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>
