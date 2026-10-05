{{-- Use the shared authenticated layout for the Create Tag page. --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Tag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Submit the new Tag name to Admin\TagController::store(). --}}
                    <form action="{{ route('admin.tags.store') }}" method="POST">
                        {{-- Protect the POST request from cross-site request forgery. --}}
                        @csrf

                        {{-- Reuse the text component; old input is restored after validation fails. --}}
                        <x-form-text-input
                            name="name"
                            label="Name*"
                            placeholder="Tag name"
                        />

                        <button
                            type="submit"
                            class="pressable inline-flex w-fit items-center gap-2.5 rounded-md border border-ink bg-accent-teal px-3.5 py-2.5 font-label text-label-m text-ink transition-all duration-[240ms] ease-in-out"
                        >
                            Create Tag
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
