<x-site-layout>
    <article class="mx-auto max-w-[65rem]">
        <header>
            <h1 class="text-heading-2xl font-normal tracking-[-0.02em] text-ink">
                {{ $tool->name }}
            </h1>
        </header>

        {{-- Preserve line breaks in the Tool description. --}}
        <div class="mt-10 whitespace-pre-line text-body-l leading-8 text-ink-soft">{{ $tool->description }}</div>
        {{-- Select the calculator using its stable key. --}}
        @if ($tool->calculator_key === 'savings-rate')
            <div class="mt-12">
                <x-savings-rate-calculator />
            </div>
        @endif
    </article>
</x-site-layout>
