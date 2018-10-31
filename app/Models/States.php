<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $fillable =[ 
	    'name_ar',
	    'name_en',
	    'country_id',
	    'city_id',
	];
	public function country_id(){
		return $this->hasOne('App\Models\Countries','id','country_id');
	}
	public function city_id(){
		return $this->hasOne('App\Models\Cities','id','city_id');
	}
}
