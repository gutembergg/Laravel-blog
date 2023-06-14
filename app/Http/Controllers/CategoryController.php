<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function create(): View 
    {
        $categories = Category::with('posts')->get();
        $tags = Tag::all();
        
        return view('blog.category', ['categories' => $categories, 'tags' => $tags]);
    }

    public function store(Request $request): RedirectResponse
    {
        $category = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        Category::create($category);
        
        return \redirect()->route('category.create');
    }
}