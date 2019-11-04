<?php

namespace Tests\Feature;


use App\Story;
use App\Comment;
use App\User;
use App\Category;
use App\Files;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function comment_can_be_added_by_user(){

        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $category = factory(Category::class)->create();
        $story = factory(Story::class)->create();
        $file = factory(Files::class)->states('story')->create();

        
        $response = $this->post('/comment/add/'.$story->id,[
            'comment' => 'Lorem ipsum dolor sit amet',
            'userc_ud' => auth()->user()->id,
            'table' => 'story',
            'table_id' => $story->id
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function user_can_edit_their_own_comments_only(){
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $story = factory(Story::class)->create();
        $file = factory(Files::class)->states('story')->create();
        $comment = factory(Comment::class)->create();

        $this->assertDatabaseHas('comments', $comment->toArray());

        $data = $comment->toArray();

        // // Change your data here
        $data['comment'] = 'Lorem ipsum';
        $data['updated_at'] = now()->addDay();

        $response = $this->post('/comment/update/'.$comment->id, $data);
        $this->assertEquals($data['comment'], $comment->refresh()->comment);

        $response->assertOk();
    }

   /** @test **/
    public function user_can_be_delete_own_comment(){
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());
        $category = factory(Category::class)->create();

        $story = factory(Story::class)->create();
        $comment = factory(Comment::class)->create();

        $this->assertDatabaseHas('comments', $comment->toArray() );
        $response = $this->get('/comment/delete/'.$comment->id);
        $this->assertDatabaseMissing('comments', $comment->toArray());

        $response->assertStatus(200);
    }
}
