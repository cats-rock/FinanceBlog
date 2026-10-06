{{-- Use the authenticated application layout so every admin page shares navigation and page structure. --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- The controller passes one Article here, so its current title can identify the form. --}}
                    <h3 class="mb-6 text-lg font-semibold">{{ $article->title }}</h3>

                    {{-- Submit the changes to the update route for this specific article. --}}
                    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST">
                        {{-- HTML forms cannot send PUT directly, so Laravel converts this POST into a PUT request. --}}
                        @method('PUT')
                        {{-- Laravel checks this token to protect the update request from CSRF attacks. --}}
                        @csrf

                        {{-- Supply the saved title as the fallback; the component prefers old input after validation fails. --}}
                        <x-form-text-input name="title" label="Title*" placeholder="Title" value="{{ $article->title }}" />

                        {{-- Supply the saved content as the fallback; old input takes priority after validation fails. --}}
                        <x-form-textarea name="content" label="Content" placeholder="Your article content" value="{{ $article->content }}" />

                        {{-- Display all Users and select the Article's current Author unless old input is available. --}}
                        <x-form-select name="author_id" label="Author" :options="$author_options" value="{{ $article->author_id }}" />

                        {{-- Display and allow changing the Article's current public/private visibility. --}}
                        <x-form-radio-buttons
                            name="is_public"
                            label="Visibility"
                            value="{{ (int) $article->is_public }}"
                            :options="[0 => 'Private draft', 1 => 'Public']"
                        />

                        {{-- Supply the Article's current Tag IDs so its existing relationships begin checked. --}}
                        <x-form-checkboxes name="tags" label="Tags" :values="$article->tags->pluck('id')->toArray()" :options="$tag_options" />

                        <button type="submit" class="pressable inline-flex w-fit items-center gap-2.5 rounded-md border border-ink bg-accent-teal px-3.5 py-2.5 font-label text-label-m text-ink transition-all duration-[240ms] ease-in-out">
                            Save changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
