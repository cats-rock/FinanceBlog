<x-site-layout>
    <x-site-page-header
        title="Tools"
        lede="Practical financial tools to help you plan, calculate, and make informed everyday decisions."
    />

    {{-- The grid grows from one to three columns as the available screen width increases. --}}
    <ul class="mt-10 grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 md:mt-[3.75rem] lg:grid-cols-3">
        @forelse ($tools as $tool)
            {{-- The component keeps every Tool preview consistent and avoids repeated markup. --}}
            <x-site-tool-card :tool="$tool" />
        @empty
            <li class="text-body-s text-ink-muted">No public tools are available yet.</li>
        @endforelse
    </ul>
</x-site-layout>
