{{-- Each component call supplies a field name and label; placeholder and saved value are optional. --}}
@props(['name', 'label', 'placeholder' => '', 'value' => ''])

<div style="margin-bottom: 1rem;">
    <label for="{{ $name }}"><b>{{ $label }}</b></label><br>
    {{-- Prefer old input after validation fails; otherwise use the optional saved value. --}}
    <input type="number" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}">
    {{-- Use the dynamic field name so this component displays its own validation error. --}}
    @error($name) <div style="color: red;">{{ $message }} </div>  @enderror
</div>
