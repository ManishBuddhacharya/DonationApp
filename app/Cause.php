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
        'goal',
        'category_id',
        'userc_id'
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

}
