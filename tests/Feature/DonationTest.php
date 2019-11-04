<?php

namespace Tests\Feature;
use App\User;
use App\Cause;
use App\Category;
use App\Donation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

     /** @test */
    public function user_can_donate(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $cause = factory(Cause::class)->create();

        
        $response = $this->get('cause/donate/'.$cause->id,[
            'amount' => 100,
            'cause_id' => $cause->id,
            'user_id' => auth()->user()->id,
            'userc_id' => auth()->user()->id
        ]);

        $response->assertOk();
    }

    /** @test */
    public function user_can_view_donate_history(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();
        
        $cause = factory(Cause::class)->create();

        
        $response = $this->get('cause/donate/'.$cause->id);

        $response->assertOk();
        
    }
}
