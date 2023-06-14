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
      </div>
    </div>
  </nav>
