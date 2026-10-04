<x-site-layout>
    <article class="mx-auto max-w-[43rem]">
        <header>
            {{-- Each Tag pill links readers to other public Articles with that Tag. --}}
            @if ($article->tags->isNotEmpty())
                <ul class="mb-6 flex flex-wrap gap-2">
                    @foreach ($article->tags as $index => $tag)
                        <li>
                            <x-site-tag-pill :tag="$tag" :index="$index" />
                        </li>
                    @endforeach
                </ul>
            @endif

            <h1 class="text-heading-2xl font-normal tracking-[-0.02em] text-ink">
                {{ $article->title }}
            </h1>

            <div class="mt-6 flex flex-wrap items-center gap-x-3 gap-y-1 font-label text-label-s text-ink-muted">
                {{-- The Article belongs to a User who acts as its Author. --}}
                @if ($article->author)
                    <a href="{{ route('authors.show', $article->author) }}" class="transition-colors duration-200 hover:text-ink">
                        by {{ $article->author->name }}
                    </a>
                @else
                    <span>by unknown</span>
                @endif

                @if ($article->created_at)
                    <span aria-hidden="true" class="text-rule-strong">/</span>
                    <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->isoFormat('D MMM YYYY') }}</time>
                @endif
            </div>
        </header>

        {{-- whitespace-pre-line preserves the paragraphs generated for long-form Article content. --}}
        <div class="mt-10 whitespace-pre-line text-body-l leading-8 text-ink-soft">{{ $article->content }}</div>
    </article>
</x-site-layout>
