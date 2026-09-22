<h1>Create new article</h1>
{{-- Submit the form with POST to the named route handled by ArticleController::store(). --}}
<form action="{{route('admin.articles.store')}}" method="POST">

    {{-- Laravel checks this CSRF token to reject form submissions from untrusted websites. --}}
    @csrf

    {{-- These names become the title and content values available in the Request object. --}}
    <div>
        <label for="title">Title</label><br>
        <input type="text" name="title" placeholder="Title">
    </div>

    <div>
        <label for="content">Content</label><br>
        <textarea name="content" placeholder="Your article content"></textarea>
    </div>

    {{-- The temporary value 1 assigns articles to the single seeded user. --}}
    <div>
        <label for="title">Author</label><br>
        <input type="number" name="author_id" placeholder="Author ID" value="1">
    </div>

    {{-- Submitting sends the form to the store route; it does not call create() again. --}}
    <button type="submit">Create article</button>
</form>
