<?php

namespace Tests\Feature;


use App\Model\Story;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendStoryTest extends TestCase
{
     use RefreshDatabase;

    /** @test */
    public function story_can_be_added_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        
        $response = $this->post('/story',[
            'title' => 'Working with community',
            'file' => 'image.jpg',
            'content' => 'lorem ipsum dolor sit amet'
        ]);

        $response->assertOk();
        $this->assertCount(1,Story::where('is_deleted',0));   
    }

    /** @test */
    public function story_list_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        
        $response = $this->get('/story');

        $response->assertOk();
    }

    /** @test */
    public function story_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        // $this->actingAs(factory(User::class)->create());

        $item = factory(Stroy::class)->create();
        
        $response = $this->get('/story/'.$item->id);

        $response->assertOk();
    }

    /** @test */
    public function cause_can_be_edited_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $item = factory(Story::class)->create();

        $this->assertDatabaseHas('story', $item->toArray());

        $data = $item->toArray();

        // // Change your data here
        $data['title'] = 'Community involvement';
        $data['updated_at'] = now()->addDay();

        $response = $this->put('/story/update/'.$item->id, $data);

        $this->assertEquals($data['title'], $item->fresh()->title);
        $this->assertEquals($data['updated_at'], $item->fresh()->updated_at);

        $response->assertRedirect('/story/'.$item->id);

        $response->assertOk();
    }

       /** @test **/
    public function Story_can_be_delete_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $item = factory(Story::class)->create();

        $this->assertDatabaseHas('story', $item->toArray() );

        $response = $this->delete('/story/delete/'. $item->id);

        $this->assertDatabaseMissing('story', $item->toArray());

        $response->assertRedirect('/story/index');
    }
}
