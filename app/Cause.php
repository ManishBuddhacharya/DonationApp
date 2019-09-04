<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Files;

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

    public function file(){
        return Files::where('table', 'Cause')->where('table_id', $this->id);
    }

}
