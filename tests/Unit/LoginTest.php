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

    public function testRegisterTest()
    {
    	// $hashed = Hash::make('test', [
					//     'rounds' => 12
					// ]);
    	// $register = User::create([
    	// 				'fname' => 'Aslan',
    	// 				'lname' => 'Test',
    	// 				'email'=> 'test@gmail.com',
    	// 				'password' => $hashed,
					// ]);
    	// $this->assertEquals('aslan', $register->name);
    }


}
