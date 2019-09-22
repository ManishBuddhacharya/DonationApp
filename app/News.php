<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
     	'title',
        'content',
        'file',
        'category_id'
    ];
    protected $table = 'news';
    public $timestamps = false;

    public function user(){
        return $user = User::where('id', $this->userc_id)->first();
        
    }

    public function newsComments(){
        $comments = Comment::where('table', 'News')->where('table_id', $this->id)->get();
        return $comments;
    }
}
