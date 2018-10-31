<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
     protected $table = 'countries';
    protected $fillable =[ 
    	'id',
	    'name_ar',
	    'name_en',
	    'code',
	    'mob',
	    'logo',
	];
}
