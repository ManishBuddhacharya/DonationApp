<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
     	'user_id',
		'cause_id',
		'amount' 
    ];

    protected $table = 'donations';
    public $timestamps = false;

    
}
