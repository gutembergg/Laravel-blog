@extends('layout.default')

@section('title', 'Enregistrer article')
    

@section('content')
<article>
    <h1>
       @if ($post->id)
           Modifier article
       @else
           Nouveau article
       @endif
    </h1>
    <form action="{{ $post->id ? route('blog.update', ['post' => $post]) : route('blog.store') }}"
         method="POST" class="form-group" enctype="multipart/form-data">
         
        @csrf
        <div>
            <label for="image">Image</label>
            <input id="image" type="file" name="image" class="form-control">
            @error('image')
                {{ $message }}
            @enderror
        </div>

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
        <select name="category" id="category" class="form-control">
            <option value="">Selectionner une categorie</option>

            @foreach ($categories as $category)
                <option value={{$category->id}}  @selected(old('category', $post->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category')
         {{ $message }}
        @enderror
       </div>
       <div>
        @php
            $tagsIds = $post->tags()->pluck('id');
        @endphp
        
        <div>Tags</div>
        <select id="tags" class="form-control multiple" name="tags[]" multiple>
            @foreach ($tags as $tag)
                <option @selected($tagsIds->contains($tag->id)) value={{$tag->id}}>{{ $tag->name }}</option>
            @endforeach
        </select>
        @error('tags')
         {{ $message }}
        @enderror
       </div>

        <button type="submit" class="btn btn-dark mt-4">
            @if ($post->id)
                Modifier
            @else
                Enregistrer
            @endif
        </button>
    </form>
 
</article>
    
@endsection