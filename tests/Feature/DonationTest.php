<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationTest extends TestCase
{
     /** @test */
    public function user_can_donate(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $cause = factory(Cause::class)->create();

        
        $response = $this->post('/donate/',[
            'amount' => 100,
            'cause_id' => $cause->id,
            'user_id' => auth()->user()->id
            'userc_id' => auth()->user()->id
        ]);

        $response->assertOk();
        $this->assertCount(1,Donation::where('is_deleted',0));   
    }

    /** @test */
    public function user_can_view_donate_history(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $cause = factory(Cause::class)->create();

        
        $response = $this->get('cause/donate/'.$cause->id);

        $response->assertOk();
        );   
    }
}
