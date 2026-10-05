{{-- The controller passes one Article here, so its current title can identify the form. --}}
<h1>Edit {{$article->title}}</h1>

{{-- Submit the changes to the update route for this specific article. --}}
<form action="{{route('admin.articles.update',$article->id)}}" method="POST">
    {{-- HTML forms cannot send PUT directly, so Laravel converts this POST into a PUT request. --}}
    @method('PUT')
    {{-- Laravel checks this token to protect the update request from CSRF attacks. --}}
    @csrf
    {{-- Supply the saved title as the fallback; the component prefers old input after validation fails. --}}
    <x-form-text-input name="title" label="Title*" placeholder="Title" value="{{$article->title}}" />

    {{-- Supply the saved content as the fallback; old input takes priority after validation fails. --}}
    <x-form-textarea name="content" label="Content" placeholder="Your article content" value="{{$article->content}}" />

    {{-- Supply the saved author ID as the fallback; old input takes priority after validation fails. --}}
    <x-form-number-input name="author_id" label="Author" placeholder="Author ID" value="{{$article->author_id}}" />

    {{-- Supply the Article's current Tag IDs so its existing relationships begin checked. --}}
    <x-form-checkboxes name="tags" label="Tags" :values="$article->tags->pluck('id')->toArray()" :options="$tag_options"/>

    <button type="submit">Save changes</button>
</form>
