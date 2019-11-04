<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Blog;
use App\Files;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendBlogTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function user_can_access_create_view_of_blog()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get('/backend/blog/add');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_blog(){
        $this->withoutExceptionHandling();
       
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();

        $this->actingAs($user);

        Storage::fake('avatars');

        $response = $this->post('/backend/blog/add/',[
            'title' => 'Working with community',
            'file' => UploadedFile::fake()->image('avatar.jpg'),
            'content' => 'lorem ipsum dolor sit amet',
            'category_id' => 1
        ]);

        // dd($response);
        $response->assertStatus(201);
        $this->assertCount(1,Blog::all());   
    }

    // /** @test */
    // public function user_can_view_detail_of_blog(){
    //     $this->withoutExceptionHandling();
        
    //     $user = factory(User::class)->create();
    //     $this->actingAs($user);

    //     $category = factory(Category::class)->create();
    //     $category = factory(Files::class)->create();
    //     $item = factory(Blog::class)->create();
        
    //     $response = $this->get('/backend/blog/detail/'.$item->id);

    //     $response->assertEquals(200,200);
    // }

    /** @test */
    public function user_can_update_blog(){
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $category = factory(Category::class)->create();

        $item = factory(Blog::class)->create();

        $this->assertDatabaseHas('blogs', $item->toArray());

        $data = $item->toArray();

        // // Change your data here
        $data['title'] = 'name';
        $data['content'] = 'paragraph';
        $data['updated_at'] = now()->addDay();

        $response = $this->post('/backend/blog/update/'.$item->id, $data);

        $response->assertOk();
    }

    /** @test **/
    public function user_can_delete_blog(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $item = factory(Blog::class)->create();
        $this->assertDatabaseHas('blogs', $item->toArray() );
        $response = $this->get('/backend/blog/delete/'. $item->id);

        $this->assertDatabaseMissing('blogs', $item->toArray());

        $response->assertOk();
    }

}
