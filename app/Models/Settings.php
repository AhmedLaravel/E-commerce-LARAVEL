<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';

    protected $fillable= [
    			'sitename_ar',
				'sitename_en',
				'logo',
				'icon',
				'mail',
				'lang',
				'time_to_deliver',
				'main_lang',
				'description',
				'keywords',
				'status',
				'about_us',
				'message_maintenance',
				'main_currency',
				'dollar_egypt',
				'euro_egypt',
				'address1',
				'address2',
				'country',
				'phone',
				'fax',
				'manager',
				'wish',
				'site_admin',
				'facebook',
				'twitter',
				'insta',
			];
}
/*

*/