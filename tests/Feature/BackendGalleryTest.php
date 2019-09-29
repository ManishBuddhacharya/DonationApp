<?php

namespace Tests\Feature;

use App\User;
use App\Files;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendGalleryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function gallery_can_be_added_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        
        Storage::fake('avatars');

        $file = UploadedFile::fake()->create('avatar.jpg',12);

        $response = $this->post('/backend/gallery/add',[
            'file_name' => 'avatar.jpg',
            'table' => 'Gallery',
            'file' => $file,
            'table_id' => 1,
            'userc_id' => 1
        ]);

        $response->assertOk();
        $this->assertCount(1,Files::where('is_deleted',0));   
    }

      /** @test */
    public function user_can_view_detail_of_gallery(){
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);
        $item = factory(Files::class)->create();

        $response = $this->get('/backend/gallery/detail/'.$item->id);

        $response->assertOk();
    }

        /** @test */
    public function user_can_update_gallery(){
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $item = factory(Files::class)->create();
        $this->assertDatabaseHas('files', $item->toArray());
        $data = $item->toArray();

        // Change your data here
        $data['file_name'] = $this->faker->name;
        $data['updated_at'] = now()->addDay();

        $response = $this->post('/backend/gallery/update/'.$item->id, $data);
        
        $this->assertEquals($data['file_name'], $item->fresh()->title);

        $response->assertOk();
    }

       /** @test **/
    public function user_can_delete_files(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $item = factory(Files::class)->create();
        $this->assertDatabaseHas('files', $item->toArray() );
        $response = $this->get('/backend/gallery/delete/'. $item->id);

        $this->assertDatabaseMissing('files', $item->toArray());

        $response->assertOk();
    }
}
