@extends('layout.default')

@section('title', 'Créer categories')
    
@section('content')

<article>

    <h2>Login:</h2>

    <form class="form-group" action="{{ route('auth.login') }}" method="post" class="vstack gap-3">
        @csrf
        <label for="email">Email</label>
        <div>
            <input id="email" type="email" name="email" class="form-control">
            @error('email')
                {{ $message }}
            @enderror
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" class="form-control">
            @error('password')
                {{ $message }}
            @enderror
        </div>
        <button type="submit" class="btn btn-dark mt-4 mb-4">Valider</button>
    </form>
</article>
    
@endsection