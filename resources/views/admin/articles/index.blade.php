{{-- Open the named create route instead of requiring its URL to be typed manually. --}}
<div>
    <a href="{{ route('admin.articles.create') }}">Create Article</a>
</div>

@foreach($articles as $article)
    <div>
        {{ $article->title }}
        {{-- Pass this article's ID to the named route so Laravel opens the correct edit form. --}}
        <a href="{{route('admin.articles.edit',$article->id)}}" >edit</a>
        <a href="" >delete</a>
    </div>
@endforeach
