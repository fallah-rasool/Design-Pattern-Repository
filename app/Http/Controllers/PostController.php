<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostController extends Controller
{
    protected $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function index()
    {
        $posts= $this->postRepository->getAll();         
        return view('post.index',compact('posts'));

        // return response()->json($this->postRepository->getAll());
    }
    public function create()
    {
        return view('post.create');
    }
    
    public function show($id)
    {
        $post = $this->postRepository->findById($id);        
        return view('post.show',compact('post'));

      //  return response()->json($this->postRepository->findById($id));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'body'=>'required|string',
            // 'image'=>'required|image|mimes:jpg,png|max:5000',
            // 'password'=>'required|numeric|min:5',
            // 'status'=>'boolean',
        ]);

    $post=$this->postRepository->create($request->all());

    if($post){   
        return back()->with('success', 'create post successfully!');              
   } else {  
        return back()->with('error', 'No create post.');  
     }

       // return response()->json($this->postRepository->create($request->all()));
    }

    public function edit($id)
    {
        $post = $this->postRepository->findById($id); 
         return view('post.edit',compact('post'));
    }

    public function update(Request $request, $id)
    {
        $updatedPost = $this->postRepository->update($id, $request->all());  

        if ($updatedPost) {  
            return redirect()->route('posts.index')->with('success', 'Post updated successfully!');  
        } 

        return back()->with('error', 'Failed to update post.'); 
         
        // return $this->postRepository->update($id, $request->all());

        // return response()->json($this->postRepository->update($id, $request->all()));
    }
    public function destroy($id)
    {
        $this->postRepository->delete($id); 
            return back()->with('success', 'delete post successfully!'); 

        // return response()->json($this->postRepository->delete($id));
    }

}
