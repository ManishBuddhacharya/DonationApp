<?php

namespace Tests\Feature;


use App\Story;
use App\User;
use App\Files;
use App\Category;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendStoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function story_can_be_added_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        Storage::fake('avatars');

        $file = UploadedFile::fake()->create('avatar.jpg');
        $category = factory(Category::class)->create();
        
        $response = $this->post('/backend/story/add',[
            'title' => $this->faker->name,
            'file' => $file,
            'content' => 'lorem ipsum dolor sit amet',
            'category_id' => $category->id
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function story_list_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        
        $item = factory(Category::class)->create();
        $story = factory(Story::class)->create();
        $item = factory(Files::class)->states('story')->create();
        $response = $this->get('/backend/story/detail/'.$story->id);

        $response->assertOk();
    }

    /** @test */
    public function story_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();
        $story = factory(Story::class)->create();
        $file = factory(Files::class)->states('story')->create();
        $response = $this->get('backend/story/detail/'.$story->id);

        $response->assertOk();
    }

    /** @test */
    public function cause_can_be_edited_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $item = factory(Story::class)->create();
        $file = factory(Files::class)->states('story')->create();

        $this->assertDatabaseHas('story', $item->toArray());

        $data = $item->toArray();

        $data['title'] = 'Community involvement';
        $data['updated_at'] = now()->addDay();

        $response = $this->post('backend/story/update/'.$item->id, $data);
        $response->assertOk();
    }

       /** @test **/
    public function Story_can_be_delete_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $item = factory(Story::class)->create();
        $file = factory(Files::class)->states('story')->create();

        $this->assertDatabaseHas('story', $item->toArray() );

        $response = $this->get('backend/story/delete/'. $item->id);

        $this->assertDatabaseMissing('story', $item->toArray());

        $response->assertStatus(200);
    }
}
