<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function index()
    {
        return view('Admin.Post.index',[
            'posts' => auth()->user()->post
        ]);
    }


    public function create()
    {
        return view('Admin.Post.create',[
            'categories' => Category::all()
        ]);
    }


    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar dengan nama yang unik dalam direktori public/images
            $imagePath = $request->file('image')->store('public/images');

            // Ubah path untuk menghapus 'public/' agar sesuai dengan URL yang benar
            $imagePath = str_replace('public/', '', $imagePath);
        }


        // Membuat slug dari judul
        $slug = Str::slug($request->title);

        // Jika slug sudah ada dalam database, tambahkan angka unik di belakangnya
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Simpan data ke dalam database
        $post = new Post();
        $post->title = $request->title;
        $post->excerpt = $request->excerpt;
        $post->body = $request->body;
        $post->image = $imagePath;
        $post->slug = $slug; // Gunakan slug yang telah dibuat
        $post->user_id = auth()->id(); // Ambil ID user yang sedang login
        $post->category_id = $request->category_id;
        $post->save();

        // Redirect atau lakukan tindakan lain setelah menyimpan data
        return redirect()->route('admin.posts')->with('success', 'Post created successfully.');
    }


    public function show(Post $post)
    {
        return view('Admin.Post.show',[
            'post' => $post]);
    }


    public function edit(Post $post)
    {
        return view('Admin.Post.update',[
            'post' => $post
        ]);
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/admin/posts');
    }
}
