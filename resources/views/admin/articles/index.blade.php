{{-- Use the authenticated application layout so every admin page shares navigation and page structure. --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Article Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Open the named create route instead of requiring its URL to be typed manually. --}}
                    <a href="{{ route('admin.articles.create') }}" class="inline-block rounded border border-gray-400 px-3 py-2">
                        Create Article
                    </a>

                    <div class="mt-6 space-y-4">
                        @foreach ($articles as $article)
                            <div class="flex flex-wrap items-center gap-3 border-b border-gray-200 pb-4">
                                <span class="font-medium">{{ $article->title }}</span>

                                {{-- Pass this Article to the named route so Laravel opens the correct edit form. --}}
                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-blue-700 underline">
                                    Edit
                                </a>

                                {{-- Deletion changes data, so submit a protected form instead of using a normal link. --}}
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST">
                                    {{-- HTML cannot send DELETE directly; Laravel converts this POST into DELETE. --}}
                                    @method('DELETE')
                                    {{-- Laravel verifies this token before accepting the destructive request. --}}
                                    @csrf
                                    <button type="submit" class="text-red-700 underline">Delete</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
