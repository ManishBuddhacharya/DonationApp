<?php

namespace Tests\Feature;
use App\User;
use App\News;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendNewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    /** @test */
    public function user_can_access_create_view_of_news()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/backend/news/add');
        $response->assertStatus(200);
    }

    /**@test */
    public function user_can_create_news){
        $this->withoutExceptionHandling();
       
        $user = factory(User::class)->create();
        $this->actingAs($user);

        Storage::fake('avatars');

        $response = $this->post('/backend/news/add/',[
            'title' => 'Working with community',
            'file' => UploadedFile::fake()->image('avatar.jpg'),
            'content' => 'lorem ipsum dolor sit amet'
        ]);


        $response->assertOk();
        $this->assertCount(1,News::all());   
    }

    /** @test */
    public function user_can_view_detail_of_news(){
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $item = factory(News::class)->create();
        $response = $this->get('/backend/news/detail/'+item->id);

        $response->assertOk();
    }

    /**@test */
    public function user_can_update_news(){
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $item = factory(News::class)->create();

        $this->assertDatabaseHas('news', $item->toArray());

        $data = $item->toArray();

        // // Change your data here
        $data['title'] = $faker->name;
        $data['content'] = $faker->paragraph;
        $data['updated_at'] = now()->addDay();

        $response = $this->put('/backend/news/update/'.$item->id, $data);

        $this->assertEquals($data['title'], $item->fresh()->title);
        $this->assertEquals($data['content'], $item->fresh()->content);
        $this->assertEquals($data['updated_at'], $item->fresh()->updated_at);

        $response->assertOk();
    }

           /** @test **/
    public function user_can_delete_news(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $item = factory(News::class)->create();
        $this->assertDatabaseHas('news', $item->toArray() );
        $response = $this->delete('/backend/news/delete/'. $item->id);

        $this->assertDatabaseMissing('news', $item->toArray());

        $response->assertOk();
    }

}
