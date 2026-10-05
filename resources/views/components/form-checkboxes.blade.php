@props(['name', 'label', 'values' => [], 'options'])

<div style="margin-bottom: 1rem;">
    <label for="{{ $name }}"><b>{{ $label }}</b></label><br>
    @foreach ($options as $tagId => $title)
        <input name="{{ $name }}[]" type="checkbox" value="{{ $tagId }}" @checked(in_array($tagId, $values))>{{ $title }}
    @endforeach
    @error($name) <div style="color: red;">{{ $message }}</div> @enderror
</div>
