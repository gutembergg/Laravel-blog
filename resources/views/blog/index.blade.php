@extends('layout.default')

@section('title', 'Mes articles')
    

@section('content')
<div>
    <h2>Mes articles</h2>
    
    @foreach ($posts as $post)
    
     <article class="mb-4">
        <h2>{{$post->title}}</h2>

        <p>Category: {{ $post->category?->name }}</p>

        @foreach ($post->tags as $tag)
            <span class="badge bg-secondary">{{ $tag->name }}</span>
        @endforeach

        <p>{{$post->content}}</p>

        <a href={{route('blog.show', ['post' => $post, 'slug' => $post->slug])}} class="btn btn-dark">Lire la suite</a>
    </article>
        
    @endforeach

    {{$posts->links()}}
</div>
    
@endsection