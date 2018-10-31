<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class UserSignUp extends Controller
{
    public function sign_up()
    {
        $title = trans('admin.sign_up');
        return view('style.create',['title'=>$title]);
    }
    public function do_sign_up(Request $request)
    {
        $rule = [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
        $niceName = [
            'name' => trans('admin.nam_user'),
            'email' => trans('admin.email_user'),
            'password' => trans('admin.pass_user'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        $data['password'] = bcrypt(request('password'));
        User::create($data);
        session()->flash('message', trans('admin.success_data_user'));
        auth()->guard('user')->attempt(['email'=>request('email'),'password' =>request('password') ], true);
        return  redirect(url('/'));
    }
}
