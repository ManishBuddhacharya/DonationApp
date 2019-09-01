<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\User;


class LoginTest extends TestCase
{
	// use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLoginTest(){
    	$hashed = Hash::make('test', [
					    'rounds' => 12
					]);
    	// $response = $this->call('POST', '/login'[
    	// 	'email' => 'test@test.com',
    	// 	'password' => $hashed
    	// ]);
    	// $this->assertTrue(true);
    	$response = $this->call('POST', '')
    	$this->assertEquals(200, $response->getStatusCode());
    	// $this->assertEquals('auth.login', $response->original->name());
    }

    // public function testRegisterTest()
    // {
    // 	$hashed = Hash::make('test', [
				// 	    'rounds' => 12
				// 	]);
    // 	$register = User::create([
    // 					'name' => 'aslan',
    // 					'email'=> 'test@gmail.com',
    // 					'password' => $hashed,
				// 	]);
    // 	$this->assertEquals('aslan', $register->name);
    // }


}
