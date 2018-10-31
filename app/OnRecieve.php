<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnRecieve extends Model
{
	protected $table = 'on_recieves';
	protected $fillable = [
		'billing_country',
		'billing_first_name',
		'billing_company',
		'billing_address_1',
		'billing_address_2',
		'billing_city',
		'billing_state',
		'billing_postcode',
		'billing_email',
		'billing_phone',
		'cart_content',
		'total',
		'currency',

	];
}
/*


*/