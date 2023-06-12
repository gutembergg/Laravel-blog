<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormPostRequest;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::paginate(1);

        return view('blog.index', [
            'posts' => $posts
        ]);
    }

    /**
     * @return Post | RedirectResponse
     */

    public function show(Post $post, string $slug)
    {
        $post = Post::find($post)->first();

        if($post->slug !== $slug) {
            return to_route('blog.show', ['post' => $post, 'slug' => $post->slug]);
        }

        return view('blog.show', ['post' => $post, 'slug' => $post->slug]);
    }
    
    public function store(FormPostRequest $request): RedirectResponse 
    {
        $post = Post::create($request->validated());

        return redirect()->route('blog.show', ['post' => $post, 'slug' => $post->slug])
                         ->with('success', "L'Article a bien été enregistré");
    }

    public function create(): View
    {
        $post = new Post();
        return view('blog.create', ['post' => $post]);
    }

    public function edit(Post $post): View
    {
        return view('blog.edit', ['post' => $post]);
    }

    public function update(Post $post, FormPostRequest $request)
    {
       // dd($post->update($request->validated()));
        $post->update($request->validated());

        return redirect()->route('blog.show', ['post' => $post, 'slug' => $post->slug])
                         ->with('success', "L'Article a bien été modifié");


    }

}