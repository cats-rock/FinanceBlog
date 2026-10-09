{{-- Use the shared authenticated layout for the Tool management page. --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-heading-l font-normal tracking-[-0.02em] text-ink">
            {{ __('Tool Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-paper shadow-sm sm:rounded-lg">
                <div class="flex flex-col gap-8 p-6 text-ink">
                    <h1 class="text-heading-l font-normal tracking-[-0.02em] text-ink">Tools</h1>

                    <ul class="flex flex-col">
                        @forelse ($tools as $tool)
                            <li class="flex flex-wrap items-center justify-between gap-4 border-t border-rule py-4 transition-colors duration-200 hover:border-ink">
                                <span class="text-body-s text-ink">{{ $tool->name }}</span>

                                <div class="flex items-center gap-4 font-label text-label-s">
                                    {{-- Open the edit form for this Tool. --}}
                                    <a
                                        href="{{ route('admin.tools.edit', $tool) }}"
                                        class="text-ink transition-colors duration-200 hover:text-ink-muted"
                                    >
                                        Edit
                                    </a>

                                    {{-- Deleting changes data, so use a CSRF-protected form. --}}
                                    <form action="{{ route('admin.tools.destroy', $tool) }}" method="POST">
                                        @method('DELETE')
                                        @csrf

                                        <button type="submit" class="text-accent-coral transition-colors duration-200 hover:text-ink">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="border-t border-rule py-4 text-body-s text-ink-muted">No tools are available yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
