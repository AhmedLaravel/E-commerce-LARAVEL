<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Department;
use \App\Models\TradeMarks;
class Departments extends Controller
{
    public function showDep(){
    	$title = trans('admin.dep');
    	$deps = Department::inRandomOrder()->get();
    	return view('style.departmentPage',['deps'=>$deps, 'title'=> $title]);
    }

    public function showTrade($id){
    	$title = trans('admin.trademarks');
    	$trades = TradeMarks::where('department',$id)->get();
        $depname = session('lang') == 'ar'?Department::find($id)->dep_name_ar:Department::find($id)->dep_name_en;
    	return view('style.tradePage',['trades'=>$trades, 'title'=> $title,'depname'=>$depname]);
    }
}
