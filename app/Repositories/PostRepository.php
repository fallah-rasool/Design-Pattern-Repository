<?php
namespace App\Repositories;
use App\Models\Post;
// use PostRepositoryInterface;

 use App\Repositories\contracts\PostRepositoryInterface;
class PostRepository implements PostRepositoryInterface
{
    protected $model;
    public function __construct(Post $post)
    {
        $this->model = $post;
    }
    public function getAll()
    {
        return $this->model->all();
    }
    public function findById($id)
    {
        return $this->model->find($id);
    }
    public function create(array $data)
    {
    //    dd( $data['status']);
        return $this->model->create([  
            'title' => $data['title'],  
            'body' => $data['body'],  
             'status' => isset($data['status']) && $data['status'] === 'on' ? 1 : 0, 
        ]); 
       
    }
    public function update($id, array $data)
    {
        $post = $this->findById($id);
        if ($post) {
            $post->title =  $data['title'];  
            $post->body =  $data['body'];  
            $post->status =  $data['status'] ? 1 : 0; // تبدیل به 0 یا 1  
            $post->save();
            return back()->with('success', 'Slider updated successfully!'); 
        }
        return null;
    }
    public function delete($id)
    {
        $post = $this->findById($id);
        if ($post) {
            return $post->delete();
        }
        return false;
    }
}




?>