<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Products;
use \App\Models\TradeMarks;
class SerchController extends Controller
{
    public function search(Request $request){
    	$s = $request->search;
    	$i = 0;
    	if($s != ''){
    		$results = Products::where('name_en','LIKE','%'.$s.'%')->orWhere('name_ar','Like','%'.$s.'%')
    		->orWhere('brand','Like','%'.$s.'%')->get();
	    		$brands = TradeMarks::where('name_en', 'LIKE' ,'%'.$s.'%')->get();
	    		return view('style.searchPage',['results'=>$results,'title'=>trans('admin.search_results'),'key_word'=>$s,'brands'=>$brands]);
    		}else{
	    		session()->flash('message',trans('admin.empty_search'));
	    		return back();
	    	}
	}
}
