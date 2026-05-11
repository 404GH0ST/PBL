<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $featured = Post::where('is_published', true)
            ->with('author')
            ->latest('published_at')
            ->take(4)
            ->get();

        $latest = Post::where('is_published', true)
            ->with('author')
            ->latest('published_at')
            ->paginate(6);

        $popular = Post::where('is_published', true)
            ->with('author')
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('blog.index', compact('featured', 'latest', 'popular'));
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published, 404);

        $related = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->with('author')
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
