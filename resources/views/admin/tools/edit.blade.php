<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit Tool
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('admin.tools.update', $tool) }}">
            @csrf
            @method('PUT')

            {{-- Show the saved name; the component preserves old input after validation errors. --}}
            <x-form-text-input
                name="name"
                label="Name*"
                placeholder="Tool name"
                :value="$tool->name"
            />
            {{-- Show the saved description and preserve submitted text after validation errors. --}}
            <x-form-textarea
                name="description"
                label="Description*"
                placeholder="Explain what this Tool does"
                :value="$tool->description"
            />
            {{-- Select the saved visibility; old input takes priority after validation errors. --}}
            <x-form-radio-buttons
                name="is_public"
                label="Visibility"
                :value="(int) $tool->is_public"
                :options="[0 => 'Private draft', 1 => 'Public']"
            />
            <button
                type="submit"
                class="pressable inline-flex w-fit items-center gap-2.5 rounded-md border border-ink bg-accent-teal px-3.5 py-2.5 font-label text-label-m text-ink transition-all duration-[240ms] ease-in-out"
            >
                Save changes
            </button>
        </form>
    </div>
</x-app-layout>
