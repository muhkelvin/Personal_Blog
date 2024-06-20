<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('User.Category.index',[
            'categories' => Category::all()
        ]);
    }


    public function create()
    {
        return view('User.Category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $slug = Str::slug($request->name);

        $originalSlug = $slug;
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug
        ]);
        return redirect()->route('user.categories')->with('success', 'Category created successfully');


    }


    public function show(Category $category)
    {
        $category->load('posts');
        return view('User.Category.show',[
            'categories' => $category
        ]);
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
