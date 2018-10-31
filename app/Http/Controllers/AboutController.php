<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class AboutController extends Controller
{
    public function aboutPage(){
    	$title = trans('admin.about');
    	$departments = Department::inRandomOrder()->get();
    	return view('style.about',['title'=>$title, 'departments'=>$departments]);
    }
}
