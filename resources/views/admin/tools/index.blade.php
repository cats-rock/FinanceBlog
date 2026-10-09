<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Tool management
        </h2>
    </x-slot>

    <div class="p-6">
        @forelse ($tools as $tool)
            <p>{{ $tool->name }}</p>
        @empty
            <p>No tools are available yet.</p>
        @endforelse
    </div>
</x-app-layout>