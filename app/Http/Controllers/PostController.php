<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request){
        $query = Post::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('body', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('sort')) {
            if ($request->sort == 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort == 'alphabetical') {
                $query->orderBy('title', 'asc');
            }
        }

        return view('Home.index', [
            'posts' => $query->paginate(10),
            'categories' => Category::all(),
            'search' => $request->search,
            'selectedCategory' => $request->category,
            'selectedSort' => $request->sort
        ]);
    }

    public function show(Post $post)
    {
        $post = $post->load(['category', 'user']);
//        dd($post->user->name);
        return view('Home.show', [
            'post' => $post
        ]);
    }
}
