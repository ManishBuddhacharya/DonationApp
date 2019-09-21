<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
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

        $response = $this->get('/backend/blog/add');
        $response->assertStatus(200);
    }

    /**@test */
    public function user_can_create_blog(){
        $this->withoutExceptionHandling();
       
        $user = factory(User::class)->create();
        $this->actingAs($user);

        Storage::fake('avatars');

        $response = $this->post('/backend/blog/add/',[
            'title' => 'Working with community',
            'file' => UploadedFile::fake()->image('avatar.jpg'),
            'content' => 'lorem ipsum dolor sit amet'
        ]);


        $response->assertOk();
        $this->assertCount(1,Story::all());   
    }

    /** @test */
    public function user_can_view_detail_of_blog(){
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $item = factory(Blog::class)->create();
        $response = $this->get('/backend/blog/detail/'+item->id);

        $response->assertOk();


    }

    /**@test */
    public function user_can_update_blog(){
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $item = factory(Blog::class)->create();

        $this->assertDatabaseHas('blog', $item->toArray());

        $data = $item->toArray();

        // // Change your data here
        $data['title'] = $faker->name;
        $data['content'] = $faker->paragraph;
        $data['updated_at'] = now()->addDay();

        $response = $this->put('/backend/blog/update/'.$item->id, $data);

        $this->assertEquals($data['title'], $item->fresh()->title);
        $this->assertEquals($data['content'], $item->fresh()->content);
        $this->assertEquals($data['updated_at'], $item->fresh()->updated_at);

        $response->assertOk();
    }

           /** @test **/
    public function user_can_delete_blog(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $item = factory(Blog::class)->create();
        $this->assertDatabaseHas('blog', $item->toArray() );
        $response = $this->delete('/backend/blog/delete/'. $item->id);

        $this->assertDatabaseMissing('blog', $item->toArray());

        $response->assertOk();
    }

}
