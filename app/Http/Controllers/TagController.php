<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $request)
    {
        $tag = Tag::create(['name' => $request->input('name')]);

        return \redirect()->route('category.create');

    }
}