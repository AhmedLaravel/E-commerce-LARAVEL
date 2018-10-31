<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'cities';
    protected $fillable =[ 
	    'name_ar',
	    'name_en',
	    'country_id',
	];
	public function country_id(){
		return $this->hasOne('App\Models\Countries','id','country_id');
	}
}
