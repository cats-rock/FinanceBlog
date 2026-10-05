@props(['name', 'label', 'values' => [], 'options'])

<fieldset class="mb-5 flex flex-col gap-2">
    <legend class="font-label text-label-s text-ink-soft">{{ $label }}</legend>

    <div class="flex flex-wrap gap-x-5 gap-y-2">
        @foreach ($options as $tagId => $title)
            <label for="{{ $name }}-{{ $tagId }}" class="flex items-center gap-2 text-body-s text-ink">
                <input
                    id="{{ $name }}-{{ $tagId }}"
                    name="{{ $name }}[]"
                    type="checkbox"
                    value="{{ $tagId }}"
                    @checked(in_array($tagId, old($name, $values)))
                    class="size-4 rounded border border-rule-strong text-accent-teal focus:outline-none focus-visible:ring-2 focus-visible:ring-accent-teal focus-visible:ring-offset-2 focus-visible:ring-offset-paper"
                >
                {{ $title }}
            </label>
        @endforeach
    </div>

    @error($name)
        <div class="font-label text-label-s text-accent-coral">{{ $message }}</div>
    @enderror
</fieldset>
