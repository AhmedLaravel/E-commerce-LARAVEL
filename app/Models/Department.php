<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $fillable =[ 
    	'dep_name_ar',
		'dep_name_en',
		'photo',
		'hint',
	];
}
