<?php

namespace Tests\Feature;


use App\Model\Story;
use App\Model\Comment;
use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendCommentTest extends TestCase
{
    /** @test */
    public function comment_can_be_added_by_user(){
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        $story = factory(Story::class)->create();

        
        $response = $this->post('/comment/',[
            'comment' => 'Lorem ipsum dolor sit amet',
            'userc_ud' => auth()->user()->id,
            'table' => 'story',
            'table_id' => $story->id
        ]);

        $response->assertOk();

        $this->assertCount(1,Comment::where('is_deleted',0));   
    }

    /** @test */
    public function comment_list_of_story_can_be_accessed_by_user(){
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());
        $story = factory(Story::class)->create();

        $response = $this->get('/comment/'.$story->id);
        $response->assertOk();
    }

    /** @test */
    public function user_can_edit_their_own_comments_only(){
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());

        $story = factory(Story::class)->create();
        $comment = factory(Comment::class)->create();

        $this->assertDatabaseHas('comment', $item->toArray());

        $data = $item->toArray();

        // // Change your data here
        $data['comment'] = 'Lorem ipsum';
        $data['updated_at'] = now()->addDay();

        $response = $this->put('/comment/'.$story->id.'/'.$comment->id, $data);
        $this->assertEquals($data['comment'], $comment->fresh()->comment);
        $this->assertEquals($data['updated_at'], $comment->fresh()->updated_at);
        $response->assertRedirect('/comment/'.$story->id);

        $response->assertOk();
    }

   /** @test **/
    public function user_can_be_delete_own_comment(){
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());

        $story = factory(Story::class)->create();
        $comment = factory(Comment::class)->create();

        $this->assertDatabaseHas('comment', $comment->toArray() );
        $response = $this->delete('/comment/delete/'. $story->id.'/'.$comment->id);
        $this->assertDatabaseMissing('comment', $comment->toArray());

        $response->assertRedirect('/comment/'.$story->id);
    }
}
