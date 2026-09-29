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
        <label for="content">Content</label><br>
        <textarea name="content" placeholder="Your article content">{{old('content', $article->content)}}</textarea>
        @error('content') <div style="color: red;">{{$message}} </div>  @enderror
    </div>



    {{-- Supply the saved title as the fallback; the component prefers old input after validation fails. --}}
    <x-form-text-input name="title" label="Title*" placeholder="Title" value="{{$article->title}}" />

    {{-- Supply the saved author ID as the fallback; old input takes priority after validation fails. --}}
    <x-form-number-input name="author_id" label="Author" placeholder="Author ID" value="{{$article->author_id}}" />

    <button type="submit">Save changes</button>
</form>
