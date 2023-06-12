@extends('layout.default')

@section('title', 'Mes articles')
    

@section('content')
<div>
    <h2>Mes articles</h2>
    
    @foreach ($posts as $post)
    
     <article>
        <h2>{{$post->title}}</h2>

        <p>{{$post->content}}</p>

        <a href={{route('blog.show', ['post' => $post, 'slug' => $post->slug])}} class="btn btn-dark">Lire la suite</a>
    </article>
        
    @endforeach

    {{$posts->links()}}
</div>
    
@endsection