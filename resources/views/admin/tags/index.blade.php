{{-- Use the shared authenticated layout for the Tag management page. --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-heading-l font-normal tracking-[-0.02em] text-ink">
            {{ __('Tag Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-paper shadow-sm sm:rounded-lg">
                <div class="flex flex-col gap-8 p-6 text-ink">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <h1 class="text-heading-l font-normal tracking-[-0.02em] text-ink">Tags</h1>

                        {{-- Open the form handled by Admin\TagController::create(). --}}
                        <a
                            href="{{ route('admin.tags.create') }}"
                            class="pressable inline-flex w-fit items-center gap-2.5 rounded-md border border-ink bg-accent-teal px-3.5 py-2.5 font-label text-label-m text-ink transition-all duration-[240ms] ease-in-out"
                        >
                            Create tag
                            <x-site-arrow class="size-4 shrink-0" />
                        </a>
                    </div>

                    <ul class="flex flex-col">
                        @forelse ($tags as $tag)
                            <li class="flex flex-wrap items-center justify-between gap-4 border-t border-rule py-4 transition-colors duration-200 hover:border-ink">
                                <span class="text-body-s text-ink">{{ $tag->name }}</span>

                                <div class="flex items-center gap-4 font-label text-label-s">
                                    {{-- Open the edit form for this Tag. --}}
                                    <a
                                        href="{{ route('admin.tags.edit', $tag) }}"
                                        class="text-ink transition-colors duration-200 hover:text-ink-muted"
                                    >
                                        Edit
                                    </a>

                                    {{-- Deleting changes data, so use a CSRF-protected form. --}}
                                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST">
                                        @method('DELETE')
                                        @csrf

                                        <button type="submit" class="text-accent-coral transition-colors duration-200 hover:text-ink">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="border-t border-rule py-4 text-body-s text-ink-muted">No tags yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
