@extends('layout.default')

@section('title', 'Enregistrer article')
    

@section('content')
<article>
    <form action="" method="POST" class="form-group">
        @csrf
       <div>
        <label for="title">Titre</label>
        <input id="title" type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
        @error('title')
            {{ $message }}
        @enderror
       </div>
       <div>
        <label for="content">Contenu</label>
           <textarea id="content" type="text" name="content" class="form-control" cols="10" rows="4">{{ old('content', $post->content) }} </textarea>
            @error('content')
                {{ $message }}
            @enderror
       </div>

       <div>
        <div>Categories</div>
        <select name="category" id="category">
            @foreach ($categories as $category)
                <option value={{$category->id}}>{{ $category->name }}</option>
            @endforeach
        </select>
       </div>
        <button type="submit" class="btn btn-dark">
            @if ($post->id)
                Modifier
            @else
                Enregistrer
            @endif
        </button>
    </form>
 
</article>
    
@endsection