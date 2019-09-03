<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class LoginTest extends TestCase
{
    use RefreshDatabase;


    public function a_user_can_login(){
        

        $this->actingAs(factory('App\User')->create());
        $attributes = ['name => 'Acme']

        $this->post('/login',$attributes);

        $this->assertDatabaseHas('LoginTest', $attributes);
    }
}
