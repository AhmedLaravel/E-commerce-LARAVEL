<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Contact;
use Validator;

class ContactController extends Controller
{
    public function contact(Request $request){
    	$rules = [
    		'name'=>'required|min:4',
    		'email'=>'required|email',
    		'message'=>'required',
    		'subject'=>'required',
    	];
    	$pretty = [
    		'name'=>trans('admin.user_name'),
    		'email'=>trans('admin.email'),
    		'message'=>trans('admin.message'),
    		'subject'=>trans('admin.subject'),
    	];
    	$data = $this->validate(request(),$rules,[],$pretty);
    	Contact::create($data);
    	session()->flash('message',trans('admin.success_contact'));
    	return back();

    }
}
