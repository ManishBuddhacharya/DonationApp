<?php

namespace Tests\Feature;

use App\Cause;
use App\User;
use App\Category;
use App\FileCause;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CauseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cause_can_be_added_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        
        $category = factory(Category::class)->create();

        Storage::fake('avatars');

        $file = UploadedFile::fake()->create('avatar.jpg',12);

        $response = $this->post('/backend/cause/add',[
            'title' => 'Women Education',
            'goal' => 5000,
            'file' => $file,
            'category_id' => 1,
            'content' => 'lorem ipsum dolor sit amet'
        ]);

        $response->assertOk();
        $this->assertCount(1,Cause::where('is_deleted',0));   
    }

    /** @test */
    public function cause_list_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        
        $response = $this->get('/backend/cause');

        $response->assertOk();
    }

    /** @test */
    public function cause_can_be_accessed_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();
        $item = factory(Cause::class)->create();
        $item = factory(FileCause::class)->create();
        
        $response = $this->get('/backend/cause/detail/'.$item->id);

        $response->assertOk();
    }

    /** @test */
    public function cause_can_be_edited_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();
        $item = factory(Cause::class)->create();
        $file = factory(FileCause::class)->create();

        $this->assertDatabaseHas('causes', $item->toArray());

        $data = $item->toArray();

        // // Change your data here
        $data['title'] = 'Women empowerment in rural areas';
        $data['goal'] = 30000;
        $data['updated_at'] = now()->addDay();

        $response = $this->post('backend/cause/update/'.$item->id, $data);

        $this->assertEquals($data['title'], $item->fresh()->title);
        $this->assertEquals($data['goal'], $item->fresh()->goal);
        $this->assertEquals($data['updated_at'], $item->fresh()->updated_at);

        $response->assertOk();
    }

       /** @test **/
    public function cause_can_be_delete_by_admin(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();
        $item = factory(Cause::class)->create();
        $file = factory(FileCause::class)->create();

        $this->assertDatabaseHas('causes', $item->toArray() );

        $response = $this->get('/backend/cause/delete/'. $item->id);

        $this->assertDatabaseMissing('causes', $item->toArray());

        // $response->assertRedirect('/cause/index');
        $response->assertOk();
    }
}

