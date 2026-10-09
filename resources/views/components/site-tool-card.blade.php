@props(['tool'])

{{-- Render one Tool preview without displaying its creator. --}}
<li class="flex flex-col border-t border-rule pt-6 transition-colors duration-200 hover:border-ink">
    <h2 class="text-heading-l font-normal tracking-[-0.02em]">
        <a href="{{ route('tools.show', $tool) }}" class="rule-in inline-block border-accent-teal text-ink">
            {{ $tool->name }}
        </a>
    </h2>

    <p class="mt-5 flex-1 text-body-s text-ink-muted">
        {{ Str::limit($tool->description, 150) }}
    </p>

    <a href="{{ route('tools.show', $tool) }}" class="mt-5 inline-flex w-fit items-center gap-3 font-label text-label-s text-ink transition-colors duration-200 hover:text-ink-muted">
        View tool
        <x-site-arrow class="size-4 shrink-0" />
    </a>
</li>
