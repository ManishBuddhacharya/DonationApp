<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\CommentReply;

class Comment extends Model
{
    public function user(){
        return $user = User::where('id', $this->userc_id)->first();
    }

    public function replies(){
        return $this->hasMany(CommentReply::class, 'comment_id');
    }

}
