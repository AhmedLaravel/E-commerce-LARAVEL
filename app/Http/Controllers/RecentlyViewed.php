<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Products;

class RecentlyViewed extends Controller
{
    public function show(){
    	$title = trans('admin.recently');
    	$recentProducts = [];
    	$recently = session('productss.recently_viewed');
    	if(!empty($recently)){
    		$recentProducts = Products::whereIn('id',$recently)->inRandomOrder()->get();
    	}
    	return view('style.recentProducts',['recents'=>$recentProducts,'title'=>$title]);
    }
}
