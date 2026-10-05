{{-- Use the shared authenticated layout for the Edit Tag page. --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Tag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Identify the Tag currently being edited. --}}
                    <h3 class="mb-6 text-lg font-semibold">
                        {{ $tag->name }}
                    </h3>

                    {{-- Submit the changes for the Tag loaded through route model binding. --}}
                    <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                        {{-- HTML cannot send PUT directly, so Laravel converts this POST into PUT. --}}
                        @method('PUT')

                        {{-- Protect the update request from cross-site request forgery. --}}
                        @csrf

                        {{-- Display the saved name, while old input takes priority after validation fails. --}}
                        <x-form-text-input
                            name="name"
                            label="Name*"
                            placeholder="Tag name"
                            value="{{ $tag->name }}"
                        />

                        <button
                            type="submit"
                            class="pressable inline-flex w-fit items-center gap-2.5 rounded-md border border-ink bg-accent-teal px-3.5 py-2.5 font-label text-label-m text-ink transition-all duration-[240ms] ease-in-out"
                        >
                            Save changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
