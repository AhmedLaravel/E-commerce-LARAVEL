<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use Swap;
class CurrencyController extends Controller
{
	public function exchange(){
		// $currency = Currency::orderBy('id','desc')->get();
		// Currency::where('code','USA')->update(['exchange_rate'=>1]);
		// if(!empty($currency)){
		// 	foreach ($currency as $current) {
		// 		$current->exchange_rate = Swap::latest($current->code."/USA");
		// 	}
		// }
	} 
    
}
/*
name
code
symbol
format
exchange_rate
active
*/
