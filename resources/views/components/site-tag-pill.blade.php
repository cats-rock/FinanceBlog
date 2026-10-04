@props([
    'tag',
    'index' => 0,
])

@php
    // Rotate through the accent colours while keeping every Tag linked to its page.
    $tones = [
        'bg-accent-teal text-ink',
        'bg-accent-sky text-ink',
        'bg-accent-gold text-ink',
        'bg-accent-indigo text-paper',
        'bg-accent-coral text-ink',
    ];

    $classes = 'inline-flex rounded-full border border-ink px-3 py-1.5 font-label text-label-s transition-transform duration-200 hover:-translate-y-0.5 '.$tones[$index % count($tones)];
@endphp

<a href="{{ route('tags.show', $tag) }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $tag->name }}
</a>
