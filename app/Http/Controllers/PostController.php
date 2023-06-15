<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormPostRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Pagination\Paginator;

class PostController extends Controller
{
    public function index(): View
    {
        return view('blog.index', [
            'posts' => Post::with('category', 'tags')->paginate(2)
        ]);
    }

    /**
     * @return View | RedirectResponse
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
       // $tags = Tag::find($request->input('category'));
        $post->category()->associate($category);
        $post->save();

        return redirect()->route('blog.show', ['post' => $post, 'slug' => $post->slug])
                         ->with('success', "L'Article a bien été enregistré");
    }

    public function create(): View
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();

        return view('blog.create', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    public function edit(Post $post): View
    {
        $categories = Category::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();

        return view('blog.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    public function update(Post $post, FormPostRequest $request)
    {
        $post->update($request->validated());
        $post->tags()->sync($request->validated('tags'));
        $category = Category::find($request->input('category'));
        $post->category()->associate($category);
        $post->save();

        return redirect()->route('blog.show', ['post' => $post, 'slug' => $post->slug])
                         ->with('success', "L'Article a bien été modifié");

    }

}