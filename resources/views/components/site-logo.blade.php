@props([
    'href' => null,
])

@php
    $classes = 'group inline-flex items-center gap-3';
@endphp

{{-- Render the same FinanceBlog mark as either a homepage link or plain text. --}}
@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span aria-hidden="true" class="block size-2.5 shrink-0 bg-accent-teal transition-transform duration-200 group-hover:scale-125"></span>
        <span class="text-heading-m font-medium tracking-[-0.02em]">FinanceBlog</span>
    </a>
@else
    <span {{ $attributes->merge(['class' => $classes]) }}>
        <span aria-hidden="true" class="block size-2.5 shrink-0 bg-accent-teal"></span>
        <span class="text-heading-m font-medium tracking-[-0.02em]">FinanceBlog</span>
    </span>
@endif
