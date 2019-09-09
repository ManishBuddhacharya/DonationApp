<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    public function user(){
        return $user = User::where('id', $this->userc_id)->first();
    }
}
