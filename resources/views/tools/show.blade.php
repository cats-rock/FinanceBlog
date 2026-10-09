<x-site-layout>
    <article class="mx-auto max-w-[43rem]">
        <header>
            <h1 class="text-heading-2xl font-normal tracking-[-0.02em] text-ink">
                {{ $tool->name }}
            </h1>
        </header>

        {{-- Preserve line breaks in the Tool description. --}}
        <div class="mt-10 whitespace-pre-line text-body-l leading-8 text-ink-soft">{{ $tool->description }}</div>
    </article>
</x-site-layout>
