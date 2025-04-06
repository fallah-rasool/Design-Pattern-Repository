<?php  

namespace Tests\Feature;  

use Illuminate\Foundation\Testing\RefreshDatabase;  
use Tests\TestCase;  
use App\Models\Post;  
use App\Repositories\PostRepository;  

class PostRepositoryTest extends TestCase  
{  
    use RefreshDatabase;  

    protected $postRepository;  

    protected function setUp(): void  
    {  
        parent::setUp();  
        $this->postRepository = new PostRepository(new Post());  
    }  

    public function test_it_can_create_a_post()  
    {  
        // داده‌های مورد نیاز برای ایجاد پست  
        $data = [  
            'title' => 'Test Post',  
            'body' => 'This is a test post content.',  
            'status' => 'on', // این وضعیت به 1 تبدیل خواهد شد  
        ];  
        
        // ایجاد پست  
        $post = $this->postRepository->create($data);  

        // بررسی اینکه پست به درستی در پایگاه داده ذخیره شده است  
        $this->assertDatabaseHas('posts', [  
            'title' => 'Test Post',  
            'body' => 'This is a test post content.',  
            'status' => 1 // اینجا بررسی می‌شود که وضعیت باید 1 باشد  
        ]);  

        // بررسی نوع بازگشتی که باید یک نمونه از Post باشد  
        $this->assertInstanceOf(Post::class, $post);  
    }  

    public function test_it_can_update_a_post()  
    {  
        // ایجاد یک پست برای ویرایش  
        $post = Post::factory()->create([  
            'title' => 'Old Title',  
            'body' => 'Old body content.',  
            'status' => 0,  
        ]);  

        // داده‌های جدید برای به‌روزرسانی پست  
        $data = [  
            'title' => 'Updated Title',  
            'body' => 'Updated body content.',  
            'status' => 'on',  
        ];  
        
        // به‌روزرسانی پست  
        $updatedPost = $this->postRepository->update($post->id, $data);  

        // بررسی تغییرات در پایگاه داده  
        $this->assertDatabaseHas('posts', [  
            'id' => $post->id,  
            'title' => 'Updated Title',  
            'body' => 'Updated body content.',  
            'status' => 1,  
        ]);  

        // بررسی اینکه پست به درستی به‌روزرسانی شده است  
        $this->assertInstanceOf(Post::class, $updatedPost);  
        $this->assertEquals('Updated Title', $updatedPost->title);  
    }  

    public function test_it_can_delete_a_post()  
    {  
        // ایجاد یک پست برای حذف  
        $post = Post::factory()->create();  

        // حذف پست  
        $result = $this->postRepository->delete($post->id);  

        // بررسی اینکه پست از پایگاه داده حذف شده است  
        $this->assertDatabaseMissing('posts', [  
            'id' => $post->id,  
        ]);  

        // بررسی نتیجه متد حذف  
        $this->assertTrue($result);  
    }  

    public function test_it_returns_false_if_post_to_delete_does_not_exist()  
    {  
        // تلاش برای حذف یک پست غیر موجود  
        $result = $this->postRepository->delete(999); // فرض کنید این ID موجود نیست  
        $this->assertFalse($result);  
    }  
}  