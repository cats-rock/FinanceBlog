{{-- Use the shared authenticated layout for the Tag management page. --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tag Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Open the form handled by Admin\TagController::create(). --}}
                    <a
                        href="{{ route('admin.tags.create') }}"
                        class="inline-block rounded border border-gray-400 px-3 py-2"
                    >
                        Create Tag
                    </a>

                    <div class="mt-6 space-y-4">
                        @foreach ($tags as $tag)
                            <div class="flex flex-wrap items-center gap-3 border-b border-gray-200 pb-4">
                                {{ $tag->name }}

                                {{-- Open the edit form for this Tag. --}}
                                <a
                                    href="{{ route('admin.tags.edit', $tag) }}"
                                    class="text-blue-700 underline"
                                >
                                    Edit
                                </a>

                                {{-- Deleting changes data, so use a CSRF-protected form. --}}
                                <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <button type="submit" class="text-red-700 underline">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>