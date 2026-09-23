{{-- Open the named create route instead of requiring its URL to be typed manually. --}}
<div>
    <a href="{{ route('admin.articles.create') }}">Create Article</a>
</div>

@foreach($articles as $article)
    <div>
        {{ $article->title }}
        {{-- Pass this article's ID to the named route so Laravel opens the correct edit form. --}}
        <a href="{{route('admin.articles.edit',$article->id)}}" >edit</a>
        {{-- Deletion changes data, so submit a protected form instead of using a normal link. --}}
        <form action="{{route('admin.articles.destroy',$article->id)}}" method="POST">
            {{-- HTML cannot send DELETE directly; Laravel converts this POST into DELETE. --}}
            @method('DELETE')
            {{-- Laravel verifies this token before accepting the destructive request. --}}
            @csrf
            <button type="submit">delete</button>
        </form>
    </div>
@endforeach
