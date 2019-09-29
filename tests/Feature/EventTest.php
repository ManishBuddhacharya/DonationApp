<?php

namespace Tests\Feature;

use App\User;
use App\Category;
use App\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
         use RefreshDatabase;

    /** @test */
    public function event_can_be_added_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();
        
        $response = $this->post('/story',[
            'title' => 'Working with community',
            'file' => 'image.jpg',
            'content' => 'lorem ipsum dolor sit amet',
            'category' => $category->id 
        ]);

        $response->assertOk();
        $this->assertCount(1,Event::where('is_deleted',0));   
    }

    /** @test */
    public function event_list_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        
        $response = $this->get('/event');

        $response->assertOk();
    }

    /** @test */
    public function event_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        // $this->actingAs(factory(User::class)->create());

        $item = factory(Event::class)->create();
        
        $response = $this->get('/event/'.$item->id);

        $response->assertOk();
    }

    /** @test */
    public function event_can_be_edited_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $item = factory(Event::class)->create();

        $this->assertDatabaseHas('event', $item->toArray());

        $data = $item->toArray();

        // // Change your data here
        $data['title'] = 'Community involvement';
        $data['updated_at'] = now()->addDay();

        $response = $this->put('/event/update/'.$item->id, $data);

        $this->assertEquals($data['title'], $item->fresh()->title);
        $this->assertEquals($data['updated_at'], $item->fresh()->updated_at);

        $response->assertRedirect('/event/'.$item->id);

        $response->assertOk();
    }

       /** @test **/
    public function event_can_be_delete_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $item = factory(Event::class)->create();

        $this->assertDatabaseHas('event', $item->toArray() );

        $response = $this->delete('/event/delete/'. $item->id);

        $this->assertDatabaseMissing('event', $item->toArray());

        $response->assertRedirect('/event/index');
    }
}
