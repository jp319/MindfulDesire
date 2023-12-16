<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * This method is responsible for displaying a list of posts.
     * It orders the posts by the 'published_at' field in descending order.
     * It also filters the posts based on the 'search' query parameter.
     * The filtered and ordered posts are then fetched from the database.
     *
     * Note: Pagination is commented out as it is handled by Livewire.
     *
     * @return View The view that displays the posts.
     */
    public function index()
    {
        $posts = Post::orderBy('published_at', 'desc')
            ->filter(request(['search']))->get();
            //->paginate(6)         // Livewire will handle
            //->withQueryString();  // the pagination.
        return view('blog', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * This method is responsible for displaying a specific post.
     * It fetches all posts from the database and then loops through them to find the post with the matching slug.
     * If the post is found, it fetches the post again from the database using the post's id.
     * If the post is not found, it aborts the request with a 404 error.
     * Note: The data of the Post in the database are all encrypted.
     *
     * @param string $slug The slug of the post.
     * @return \Illuminate\Contracts\View\View The view that displays the post.
     */
    public function show(string $slug)
    {
        // Fetch all posts from the database.
        $posts = Post::all();

        // Initialize a new Post object.
        $post = new Post();

        // Loop through all posts to find the post with the matching slug.
        foreach ($posts as $p) {
            // Decrypt the slug and compare it with the slug from the URL.
            // Note: The slug is encrypted in the database.
            if ($p->slug === $slug) {
                // Note: The data of the Post in the database are all encrypted.
                $post = $p;
                break;
            }
        }

        // If the post is not found, abort the request with a 404 error.
        if (!$post) {
            abort(404);
        }

        // Return the view that displays the post.
        return view('post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
