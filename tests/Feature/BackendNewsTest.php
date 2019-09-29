<?php

namespace Tests\Feature;
use App\User;
use App\News;
use App\Category;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendNewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function user_can_access_create_view_of_news()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get('/backend/news/add');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_news(){
        $this->withoutExceptionHandling();

        Storage::fake('avatars');

        $file = UploadedFile::fake()->create('avatar.jpg',12);
        
        $user = factory(User::class)->create();
        $this->actingAs($user);
        
        $category = factory(Category::class)->create();


        $response = $this->post('/backend/news/add/',[
            'title' => 'Working with community',
            'file' => $file,
            'content' => 'lorem ipsum dolor sit amet',
            'category_id' => $category->id
        ]);

        $response->assertOk();
        $this->assertCount(1,News::all());   
    }

    /** @test */
    public function user_can_view_detail_of_news(){
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);
        
        $category = factory(Category::class)->create();
        
        $item = factory(News::class)->create();

        $response = $this->get('/backend/news/detail/'.$item->id);

        $response->assertOk();
    }

    /** @test */
    public function user_can_update_news(){
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $category = factory(Category::class)->create();

        $item = factory(News::class)->create();

        $this->assertDatabaseHas('news', $item->toArray());

        $data = $item->toArray();
        

        // Change your data here
        $data['title'] = $this->faker->name;
        $data['content'] = $this->faker->paragraph;
        $data['updated_at'] = now()->addDay();

        $response = $this->post('/backend/news/update/'.$item->id, $data);
        
        $this->assertEquals($data['title'], $item->fresh()->title);
        $this->assertEquals($data['content'], $item->fresh()->content);

        $response->assertOk();
    }

   /** @test **/
    public function user_can_delete_news(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $item = factory(News::class)->create();
        $this->assertDatabaseHas('news', $item->toArray() );
        $response = $this->get('/backend/news/delete/'. $item->id);

        $this->assertDatabaseMissing('news', $item->toArray());

        $response->assertOk();
    }

}
