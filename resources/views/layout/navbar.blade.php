@php

    $route_name = request()->route()->getName();
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Laravel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a @class([
              'nav-link',
              'active' => str_starts_with($route_name, 'blog.'),
          ]) aria-current="page" href={{ route('blog.index') }}>Blog</a>
          </li>
          <li class="nav-item">
            <a @class([
              'nav-link',
              'active' => $route_name == 'blog.create'
              ]) href={{route('blog.create')}}>Enregistrer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href={{ route('category.create') }}>Categories</a>
          </li>
         
        </ul>
        <div class="navbar-nav ms-auto mb-2 mb-lg-0 text-secondary">

          @auth
        
            {{ \Illuminate\Support\Facades\Auth::user()->name }}

            <form class="nav-item" action="{{ route('auth.logout') }}" method="post">
              @method('delete')
              @csrf
              <button type="submit" class="nav-link text-secondary">Se déconnecter</button>
            </form>
          
          @endauth

          @guest
              
          <a class="nav-link" href={{ route('auth.login') }}>Se connecter</a>
          @endguest
        </div>
      </div>
    </div>
  </nav>
