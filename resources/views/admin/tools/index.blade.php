<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Tool management
        </h2>
    </x-slot>

    <div class="p-6">
        @forelse ($tools as $tool)
            <div class="flex flex-wrap items-center justify-between gap-4 border-t border-rule py-4">
                <span class="text-body-s text-ink">{{ $tool->name }}</span>

                {{-- Open the editing form for this specific Tool. --}}
                <a
                    href="{{ route('admin.tools.edit', $tool) }}"
                    class="font-label text-label-s text-ink transition-colors duration-200 hover:text-ink-muted"
                >
                    Edit
                </a>
            </div>
        @empty
            <p>No tools are available yet.</p>
        @endforelse
    </div>
</x-app-layout>
