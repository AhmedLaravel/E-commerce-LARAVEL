<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manifacturers extends Model
{
    protected $title = 'manifacturers';
 	protected $fillable = [
 		'name_en',
		'name_ar',
		'facebook',
		'twitter',
		'website',
		'lat',
		'lng',
		'contact_name',
		'icon',
		'email',
		'mobile',
		'address',
 	];
}
