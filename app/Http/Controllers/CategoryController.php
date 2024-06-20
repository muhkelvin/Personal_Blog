<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('Home.Category.index',[
            'categories' => Category::all(),
        ]);
    }

    public function show(Category $category){
//        $category = $category->load('posts')->paginate(10);
//        dd($category->posts->title);
        $posts = $category->posts()->paginate(5);

        return view('Home.Category.show',[
            'category' => $category
            ,'posts' => $posts
        ]);
    }
}
