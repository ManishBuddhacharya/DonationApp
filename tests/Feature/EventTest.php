<?php

namespace Tests\Feature;

use App\User;
use App\Category;
use App\Event;
use App\Files;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function event_can_be_added_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();
        Storage::fake('avatars');

        $file = UploadedFile::fake()->create('avatar.jpg');

        $response = $this->post('backend/event/add',[
            'title' => $this->faker->name,
            'file' => $file,
            'content' => $this->faker->paragraph,
            'category_id' => $category->id,
            'address' =>  $this->faker->address,
            'dateTime' => now()
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function event_list_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $story = factory(Event::class)->create();

        $item = factory(Files::class)->states('event')->create();
        
        $response = $this->get('backend/event');

        $response->assertOk();
    }

    /** @test */
    public function event_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $item = factory(Event::class)->create();
        $item = factory(Files::class)->states('event')->create();
        
        $response = $this->get('backend/event/detail/'.$item->id);

        $response->assertOk();
    }

    /** @test */
    public function event_can_be_edited_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $item = factory(Event::class)->create();

        $this->assertDatabaseHas('events', $item->toArray());

        $data = $item->toArray();

        // // Change your data here
        $data['title'] = $this->faker->name;
        $data['updated_at'] = now()->addDay();

        $response = $this->post('backend/event/update/'.$item->id, $data);

        $this->assertEquals($data['title'], $item->refresh()->title);
        $response->assertOk();
    }

       /** @test **/
    public function event_can_be_delete_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $item = factory(Event::class)->create();

        $this->assertDatabaseHas('events', $item->toArray() );

        $response = $this->get('backend/event/delete/'. $item->id);

        $this->assertDatabaseMissing('events', $item->toArray());

        $response->assertStatus(200);
    }
}
