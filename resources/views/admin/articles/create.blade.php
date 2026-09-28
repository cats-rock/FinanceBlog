<h1>Create new article</h1>
{{-- Submit the form with POST to the named route handled by ArticleController::store(). --}}
<form action="{{route('admin.articles.store')}}" method="POST">

    {{-- Laravel checks this CSRF token to reject form submissions from untrusted websites. --}}
    @csrf

    {{-- These field names become values available in the Request object. --}}

    <div>
        <label for="content">Content</label><br>
        <textarea name="content" placeholder="Your article content">{{old('content')}}</textarea>
        @error('content') <div style="color: red;">{{$message}} </div>  @enderror
    </div>

    {{-- The submitted author ID must match an existing user before the controller creates the article. --}}
    <div>
        <label for="title">Author</label><br>
        <input type="number" name="author_id" placeholder="Author ID" value="{{old('author_id')}}">
        @error('author_id') <div style="color: red;">{{$message}} </div>  @enderror
    </div>

    {{-- Blade replaces this tag with the reusable title input component and passes these attributes as props. --}}
    <x-form-text-input name="title" label="Title*" placeholder="Title" />

    {{-- Submitting sends the form to the store route; it does not call create() again. --}}
    <button type="submit">Create article</button>
</form>
