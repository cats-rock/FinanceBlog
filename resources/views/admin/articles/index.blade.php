{{-- Use the authenticated application layout so every admin page shares navigation and page structure. --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-heading-l font-normal tracking-[-0.02em] text-ink">
            {{ __('Article Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-paper shadow-sm sm:rounded-lg">
                <div class="flex flex-col gap-8 p-6 text-ink">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <h1 class="text-heading-l font-normal tracking-[-0.02em] text-ink">Articles</h1>

                        {{-- Open the named create route instead of requiring its URL to be typed manually. --}}
                        <a href="{{ route('admin.articles.create') }}" class="pressable inline-flex w-fit items-center gap-2.5 rounded-md border border-ink bg-accent-teal px-3.5 py-2.5 font-label text-label-m text-ink transition-all duration-[240ms] ease-in-out">
                            Create article
                            <x-site-arrow class="size-4 shrink-0" />
                        </a>
                    </div>

                    <ul class="flex flex-col">
                        @forelse ($articles as $article)
                            <li class="flex flex-wrap items-center justify-between gap-4 border-t border-rule py-4 transition-colors duration-200 hover:border-ink">
                                <span class="text-body-s text-ink">{{ $article->title }}</span>

                                <div class="flex items-center gap-4 font-label text-label-s">
                                    {{-- Pass this Article to the named route so Laravel opens the correct edit form. --}}
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-ink transition-colors duration-200 hover:text-ink-muted">
                                        Edit
                                    </a>

                                    {{-- Deletion changes data, so submit a protected form instead of using a normal link. --}}
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST">
                                        {{-- HTML cannot send DELETE directly; Laravel converts this POST into DELETE. --}}
                                        @method('DELETE')
                                        {{-- Laravel verifies this token before accepting the destructive request. --}}
                                        @csrf
                                        <button type="submit" class="text-accent-coral transition-colors duration-200 hover:text-ink">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="border-t border-rule py-4 text-body-s text-ink-muted">No articles yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
