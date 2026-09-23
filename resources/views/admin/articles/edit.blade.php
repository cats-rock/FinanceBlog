{{-- The controller passes one Article here, so its current title can identify the form. --}}
<h1>Edit {{$article->title}}</h1>
{{-- Submit the changes to the update route for this specific article. --}}
<form action="{{route('admin.articles.update',$article->id)}}" method="POST">
    {{-- HTML forms cannot send PUT directly, so Laravel converts this POST into a PUT request. --}}
    @method('PUT')
    {{-- Laravel checks this token to protect the update request from CSRF attacks. --}}
    @csrf

    {{-- Prefill each field with the article's existing value so it can be edited. --}}
    <div>
        <label for="title">Title</label><br>
        <input type="text" name="title" placeholder="Title" value="{{$article->title}}">
    </div>

    <div>
        <label for="content">Content</label><br>
        <textarea name="content" placeholder="Your article content">{{$article->content}}</textarea>
    </div>

    {{-- The author ID remains editable for now; authenticated ownership will be improved later. --}}
    <div>
        <label for="title">Author</label><br>
        <input type="number" name="author_id" placeholder="Author ID" value="{{$article->author_id}}">
    </div>

    <button type="submit">Save changes</button>
</form>
