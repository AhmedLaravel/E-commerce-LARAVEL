<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingCompanies extends Model
{
    protected $table = 'shipping_companies';
    protected $fillable = [
    	'name_en',
    	'name_ar',
		'email',
		'mobile',
		'facebook',
		'address',
		'twitter',
		'website',
		'lat',
		'lng',
		'contact_name',
    ];
}
