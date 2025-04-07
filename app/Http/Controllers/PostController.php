<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

       return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'body'=>'required|string',
            // 'image'=>'required|image|mimes:jpg,png|max:5000',
            // 'password'=>'required|numeric|min:5',
            // 'status'=>'boolean',
        ]);

        $post = Post::create([  
            'title' => $request->title,  
            'body' => $request->body,  
            'status' => $request->status ? 1 : 0, 
        ]);  
        if($post){   
            return back()->with('success', 'create post successfully!');  
        
        } else {  
            return back()->with('error', 'No create post.');  
         }  
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
         return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->title =  $request->title;  
            $post->body =  $request->body;  
            $post->status =   $request->status ? 1 : 0; // تبدیل به 0 یا 1  
            $post->save();
            return back()->with('success', 'Slider updated successfully!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete(); 
        return back()->with('success', 'delete post successfully!'); 
    }

}
