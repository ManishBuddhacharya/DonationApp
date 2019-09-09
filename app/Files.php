<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = [
     	'name',
		'table_name',
		'table_id' 
    ];

    protected $table = 'files';
    public $timestamps = false;
}
