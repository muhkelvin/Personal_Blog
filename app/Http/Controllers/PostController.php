<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('Home.index',[
            'posts' => Post::paginate(10),
            'categories' => Category::all()
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
