<h1>Create new article</h1>
{{-- Submit the form with POST to the named route handled by ArticleController::store(). --}}
<form action="{{route('admin.articles.store')}}" method="POST">

    {{-- Laravel checks this CSRF token to reject form submissions from untrusted websites. --}}
    @csrf

    {{-- Blade replaces this tag with the reusable title input component and passes these attributes as props. --}}
    <x-form-text-input name="title" label="Title*" placeholder="Title" />

    {{-- A new article has no saved content fallback; the component restores old input after validation fails. --}}
    <x-form-textarea name="content" label="Content" placeholder="Your article content" />

    {{-- A new article has no saved author fallback; the component restores old input after validation fails. --}}
    <x-form-number-input name="author_id" label="Author" placeholder="Author ID" />

    {{-- Display one checkbox for every Tag supplied by ArticleController::create(). --}}
     <x-form-checkboxes name="tags" label="Tags" :options="$tag_options"/>

    {{-- Submitting sends the form to the store route; it does not call create() again. --}}
    <button type="submit">Create article</button>
</form>
