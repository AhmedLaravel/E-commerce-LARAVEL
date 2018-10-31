<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name_ar',
    	'color_name_ar',
        'name_en',
		'color_name_en',
        'logo',
		'color',
		'brand',
		'description',
        'price',
        'model',
        'catalog',
        'file_name',
		'size',
		'discount',
        'email',
		'shipping_cost',
		'parent',
    ];
    public function presentPrice(){
    	return '$'.$this->price;
    }
    public function department(){
    	return $this->hasOne('\App\Models\Department','id','parent');
    }
}
