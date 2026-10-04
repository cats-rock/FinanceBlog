@props([
    'label',
    'href',
    'active' => false,
    'variant' => 'desktop',
])

@php
    // Desktop and mobile links share behaviour but use layouts suited to their space.
    $classes = 'group inline-flex items-center transition-all duration-[240ms] ease-in-out';

    if ($variant === 'desktop') {
        $classes .= ' gap-1.5 border-b-4 px-1 pb-5 font-label text-label-m';
        $classes .= $active
            ? ' border-ink text-ink'
            : ' border-transparent text-ink-muted hover:border-accent-teal hover:text-ink';
    } else {
        $classes .= ' w-full justify-between gap-2 py-4 font-label text-label-s';
        $classes .= $active
            ? ' text-ink'
            : ' text-ink-muted hover:text-ink';
    }
@endphp

<a href="{{ $href }}" @if ($active) aria-current="page" @endif {{ $attributes->merge(['class' => $classes]) }}>
    <span>{{ $label }}</span>

    @if ($variant === 'mobile')
        <x-site-arrow class="size-4 shrink-0 transition-colors duration-200 group-hover:text-accent-teal" />
    @endif
</a>
