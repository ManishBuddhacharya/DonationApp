<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
     	'title',
        'content',
        'address',
        'dateTime',
        'category_id',
        'userc_id'
    ];
    protected $table = 'events';
    public $timestamps = false;

    public function user(){
        return $user = User::where('id', $this->userc_id)->first();
        
    }

    public function eventComments(){
        $comments = Comment::where('table', 'Event')->where('table_id', $this->id)->get();
        return $comments;
    }
}
