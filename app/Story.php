<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;

class Story extends Model
{
	protected $fillable = [
     	'title',
        'content',
        'file',
        'category_id'
    ];
    protected $table = 'story';
    public $timestamps = false;

    public function user(){
        return $user = User::where('id', $this->userc_id)->first();
        
    }

    public function storyComments(){
        $comments = Comment::where('table', 'Story')->where('table_id', $this->id)->get();
        return $comments;
    }
}
