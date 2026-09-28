{{-- Each component call supplies a field name and label; placeholder and value are optional. --}}
@props(['name', 'label', 'placeholder' => '', 'value' => ''])

<div style="margin-bottom: 1rem;">
    <label for="{{ $name }}"><b>{{ $label }}</b></label><br>
    {{-- Prefer the previous submission after validation fails; otherwise use the supplied value. --}}
    <input type="text" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}">
    {{-- The dynamic field name displays the validation error belonging to this component instance. --}}
    @error($name) <div style="color: red;">{{ $message }} </div>  @enderror
</div>
