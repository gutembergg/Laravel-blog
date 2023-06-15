@extends('layout.default')

@section('title', 'Créer categories')
    
@section('content')

<article>
    <h1>Enregistrer categories</h1>
    <form class="form-group" action="" method="post">
        @csrf
        <label for="name">Name</label>
        <div>
            <input id="name" type="text" name="name" class="form-control">
            @error('name')
                {{ $message }}
            @enderror
        </div>
        <button type="submit" class="btn btn-dark mt-4 mb-4">Valider</button>
    </form>

    <h2>Categories</h2>

    <ul>
        @foreach ($categories as $category)

            <li>{{$category->name}}
                {{ $category->posts->count() > 1 ?
                   $category->posts->count() .' '.'Articles' :
                   $category->posts->count() .' '.'Article' 
                }}
            </li>

        @endforeach
    </ul>

    <h2>Tags</h2>

    <form class="form-group" action={{ route('tags.store') }} method="post">
        @csrf
        <label for="tag">Name</label>
        <div>
            <input id="tag" type="text" name="name" class="form-control">
       
            @error('tags')
                {{ $message }}
            @enderror
        </div>
        <button type="submit" class="btn btn-dark mt-4 mb-4">Valider</button>
    </form>

    @foreach ($tags as $tag)
        <div>{{$tag->name}}</div>
    @endforeach
  
</article>
    
@endsection