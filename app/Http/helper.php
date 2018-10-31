<?php
if(!function_exists('aurl')){
	function aurl($aurl = null){
		return url('admin/'.$aurl);
	}
}
if(!function_exists('currency_USD_EUR')){
	function currency_USD_EUR($price = null){
		return currency($price, "USD", "EUR");
	}
}
if(!function_exists('currency_USD_EGP')){
	function currency_USD_EGP($price = null){
		return currency($price, "USD", "EGP");
	}
}
if(!function_exists('currency_USD_USD')){
	function currency_USD_USD($price = null){
		return currency($price, "USD", "USD");
	}
}

if(!function_exists('uurl')){
	function uurl($uurl = null){
		return url('users/'.$uurl);
	}
}
if(!function_exists('settings')){
	function settings(){
		return App\Models\Settings::orderBy('id','desc')->first();
	}
}
if(!function_exists('up')){
	function up(){
		return new \App\Http\Controllers\Upload;
	}
}

if(!function_exists('admin')){
	function admin(){
		return auth()->guard('admin');
	}
}
if(!function_exists('active')){
	function active($link){
		// preg_match('/'.$link.'/1', Request::segment(2));
		if($link == Request::segment(2) ){
			return ['menu-open', 'display: block'];
		}else{
			return ['',''];
		}
	}
}
if(!function_exists('userAuth')){
	function userAuth(){
		return auth()->guard('user');
	}
}
if(!function_exists('lang')){
	function lang(){
		if(session()->has('lang')){
			return session('lang');
		}else{
			session()->put('lang', settings()->main_lang);
			return settings()->main_lang;
		}
	}
}
if(!function_exists('direction')){
	function direction(){
		if(session('lang') == 'ar' ){
			return 'rtl';
		}else{
			return 'ltr';
		}
	}
}
if(!function_exists('languageData')){
	function languageData(){
		return [
			"sProcessing"=> trans('admin.sProcessing'),
            "sLengthMenu"=> trans('admin.sLengthMenu'),
            "sZeroRecords"=> trans('admin.sZeroRecords'),
            "sEmptyTable"=> trans('admin.sEmptyTable'),
            "sInfo"=> trans('admin.sInfo'),
            "sInfoEmpty"=> trans('admin.sInfoEmpty'),
            "sInfoFiltered"=> trans('admin.sInfoFiltered'),
            "sInfoPostFix"=> trans('admin.sInfoPostFix'),
            "sSearch"=>trans('admin.sSearch'),
            "sUrl"=> trans('admin.sUrl'),
            "sInfoThousands"=> trans('admin.sInfoThousands'),
            "sLoadingRecords"=> trans('admin.sLoadingRecords'),
            "oPaginate"=>[
                "sFirst"=> trans('admin.sFirst'),
                "sLast"=> trans('admin.sLast'),
                "sNext"=> trans('admin.sNext'),
                "sPrevious"=> trans('admin.sPrevious'),
            ],
            "oAria"=> [
                "sSortAscending"=> trans('admin.sSortAscending'),
                "sSortDescending"=>trans('admin.sSortDescending'),
            ]
        ];
	}
}
////////////////Validator Functions/////////////////
if(!function_exists('v_image')){
	function v_image($ext = null){
		if($ext === null){
			return 'image|mimes:jpeg,jpg,bmp,gif,png';
		}else{
			return 'image|mimes:'.$ext;		
		}
	}
}
////////////////Validator Functions////////////////