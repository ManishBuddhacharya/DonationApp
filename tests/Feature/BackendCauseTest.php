<?php

namespace Tests\Feature;

use App\Model\Cause;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CauseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cause_can_be_added_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        
        $response = $this->post('/cause',[
            'title' => 'Women Education',
            'goal' => 5000,
            'file' => 'image.jpg',
            'content' => 'lorem ipsum dolor sit amet'
        ]);

        $response->assertOk();
        $this->assertCount(1,Cause::where('is_deleted',0));   
    }

    /** @test */
    public function cause_list_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        
        $response = $this->get('/cause');

        $response->assertOk();
    }

    /** @test */
    public function cause_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $item = factory(Cause::class)->create();
        
        $response = $this->get('/cause/'.$item->id);

        $response->assertOk();
    }

    /** @test */
    public function cause_can_be_edited_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $item = factory(Cause::class)->create();

        $this->assertDatabaseHas('cause', $item->toArray());

        $data = $item->toArray();

        // // Change your data here
        $data['title'] = 'Women empowerment in rural areas';
        $data['goal'] = 30000;
        $data['updated_at'] = now()->addDay();

        $response = $this->put('/cause/update/'.$item->id, $data);

        $this->assertEquals($data['title'], $item->fresh()->title);
        $this->assertEquals($data['goal'], $item->fresh()->goal);
        $this->assertEquals($data['updated_at'], $item->fresh()->updated_at);

        $response->assertRedirect('/cause/'.$item->id);

        $response->assertOk();
    }

       /** @test **/
    public function cause_can_be_delete_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $item = factory(Cause::class)->create();

        $this->assertDatabaseHas('cause', $item->toArray() );

        $response = $this->delete('/cause/delete/'. $item->id);

        $this->assertDatabaseMissing('cause', $item->toArray());

        $response->assertRedirect('/cause/index');
    }
}

