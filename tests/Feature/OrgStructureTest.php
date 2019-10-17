<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Position;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function user_can_access_organization_list(){
        $this->withoutExceptionHandling();

        $response = $this->get('/backend/organization/list');
        $response->assertStatus(200);
    }

        /** @test */
    public function position_can_be_added_by_user(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $postion = factory(Position::class)->create();
                
        $response = $this->post('/backend/organization/add',[
            'user_id' => $user->id,
            'position_id' => $position->id,
        ]);

        $response->assertOk();

        $this->assertCount(1,UserPosition::where('is_deleted',0));   
    }


}
