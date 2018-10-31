<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
	protected $table  = 'accessories';
	protected $fillable  = [
		'name_en',
		'name_ar',
		'prod_name_ar',
		'prod_name_en',
		'photo',
	];
}
