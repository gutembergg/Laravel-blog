@extends('layout.default')

@section('title', $post->title)
    

@section('content')
<article>
    <h2>{{$post->title}}</h2>

    <p>{{$post->content}}</p>


    <a href={{ route('blog.edit', ['post' => $post]) }} class="btn btn-dark">Modifier</a>
</article>
    
@endsection