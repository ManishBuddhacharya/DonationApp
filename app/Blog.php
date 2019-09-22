<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;

class Blog extends Model
{
    protected $fillable = [
     	'title',
        'content',
        'file',
        'category_id'
    ];
    protected $table = 'blogs';
    public $timestamps = false;

    public function user(){
        return $user = User::where('id', $this->userc_id)->first();
        
    }

    public function blogComments(){
        $comments = Comment::where('table', 'Blog')->where('table_id', $this->id)->get();
        return $comments;
    }
}
