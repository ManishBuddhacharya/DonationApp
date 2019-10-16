<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
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
    public function user_can_access_profile(){
        $this->withoutExceptionHandling();

        $response = $this->get('/backend/setting');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_update_profile(){
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $user['name'] = $faker->name;
        $user['email'] = $faker->unique()->safeEmail;
        $user['address'] = $faker->city;
        $user['phone'] = $faker-> randomDigit;

        $response = $this->post('/backend/setting/profile/update/'+$user->id);

        $response->assertOk();
    }

    /**@test */
    public function user_can_update_image(){
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        Storage::fake('avatars');

        $file = UploadedFile::fake()->create('avatar.jpg',12);

        $user['profile_pic'] = $file;
        $response = $this->post('/backend/setting/profile/picture/update/'.$user->id);

        $this->assertEquals($user['profile_pic'], $user->fresh()->profile_pic);

        $response->assertOk();
    }

    /** @test */
    public function user_can_update_password(){
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $user['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        
        $response = $this->post('/backend/setting/password/update/'+$user->id);
        $this->assertEquals($user['password'], $user->fresh()->password);
        $response->assertOk();
    }

}
