<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $posts_with_no_category = Post::whereDoesntHave('categories')->count();
        return view('categories', compact('categories', 'posts_with_no_category'));
    }
    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $name = Category::where('slug', $slug)->firstOrFail()->name;
        if ($slug === 'uncategorized') {
            $posts = Post::whereDoesntHave('categories')->get();
        } else {
            $posts = Post::whereHas('categories', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->get();
        }
        return view('categorized-posts', compact('posts', 'name'));
    }
}
