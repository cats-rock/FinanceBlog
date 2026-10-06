{{-- Use the authenticated application layout so every admin page shares navigation and page structure. --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Submit the form with POST to the named route handled by ArticleController::store(). --}}
                    <form action="{{ route('admin.articles.store') }}" method="POST">
                        {{-- Laravel checks this CSRF token to reject form submissions from untrusted websites. --}}
                        @csrf

                        {{-- Blade replaces this tag with the reusable title input component and passes these attributes as props. --}}
                        <x-form-text-input name="title" label="Title*" placeholder="Title" />

                        {{-- A new article has no saved content fallback; the component restores old input after validation fails. --}}
                        <x-form-textarea name="content" label="Content" placeholder="Your article content" />

                        {{-- Display Users as readable Author choices and restore the submitted choice after validation fails. --}}
                        <x-form-select name="author_id" label="Author" :options="$author_options" />

                        {{-- Choose whether visitors can see the Article immediately or whether it remains a private draft. --}}
                        <x-form-radio-buttons
                            name="is_public"
                            label="Visibility"
                            value="0"
                            :options="[0 => 'Private draft', 1 => 'Public']"
                        />

                        {{-- Display one checkbox for every Tag supplied by ArticleController::create(). --}}
                        <x-form-checkboxes name="tags" label="Tags" :options="$tag_options" />

                        {{-- Submitting sends the form to the store route; it does not call create() again. --}}
                        <button type="submit" class="pressable inline-flex w-fit items-center gap-2.5 rounded-md border border-ink bg-accent-teal px-3.5 py-2.5 font-label text-label-m text-ink transition-all duration-[240ms] ease-in-out">
                            Create article
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
