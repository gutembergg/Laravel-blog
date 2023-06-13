@extends('layout.default')

@section('title', 'Créer categories')
    
@section('content')

<article>
    <h1>Enregistrer categories</h1>
    <form action="" method="post">
        @csrf
        <label for="name">Name</label>
        <div>
            <input id="name" type="text" name="name">
            @error('name')
                {{ $message }}
            @enderror
        </div>
        <button type="submit">Valider</button>
    </form>

    <h2>Categories</h2>

    <ul>
        @foreach ($categories as $category)

            <li>{{$category->name}}</li>

        @endforeach
    </ul>
  
</article>
    
@endsection