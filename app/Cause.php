<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;

class Cause extends Model
{
    protected $fillable = [
     	'title',
        'content',
        'file',
        'goal',
        'category_id'
    ];
    protected $table = 'causes';
    public $timestamps = false;

    public function user(){
        return $user = User::where('id', $this->userc_id)->first();
        
    }

    public function causeComments(){
        $comments = Comment::where('table', 'Cause')->where('table_id', $this->id)->get();
        return $comments;
    }

    public function transactions(){
        return $this->hasMany('App\Donation', 'cause_id', 'id');
    }

}
