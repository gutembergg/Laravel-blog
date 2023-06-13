<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;
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
        $post = Post::find($post->id);
        $post->category;

        if($post->slug !== $slug) {
            return to_route('blog.show', ['post' => $post, 'slug' => $post->slug]);
        }

        return view('blog.show', ['post' => $post, 'slug' => $post->slug]);
    }
    
    public function store(FormPostRequest $request): RedirectResponse 
    {
        $post = Post::create($request->validated());
        $category = Category::find($request->input('category'));
        $post->category()->associate($category);
        $post->save();

        return redirect()->route('blog.show', ['post' => $post, 'slug' => $post->slug])
                         ->with('success', "L'Article a bien été enregistré");
    }

    public function create(): View
    {
        $post = new Post();
        $categories = Category::all();

        return view('blog.create', ['post' => $post, 'categories' => $categories]);
    }

    public function edit(Post $post): View
    {
        $categories = Category::all();

        return view('blog.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update(Post $post, FormPostRequest $request)
    {
       // dd($post->update($request->validated()));
        $post->update($request->validated());

        return redirect()->route('blog.show', ['post' => $post, 'slug' => $post->slug])
                         ->with('success', "L'Article a bien été modifié");

    }

}