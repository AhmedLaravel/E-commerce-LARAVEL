<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use App\Admin;
use App\Mail\AdminResetPassword;
use Auth;
use Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
class adminAuth extends Controller
{
    public function login(){
    	return view('admin.login');
    } 
    public function do_login(){
    	$remember = request('rememberme') == 1? true: false;
    	if(Auth::guard('admin')->attempt(['email'=>request('email'),'password' =>request('password') ], $remember)){
    		return  redirect('admin');
    	}else{
    		return redirect('admin/login');
    	}
    }
    public function do_logout(){
    	admin()->logout();
    	return redirect('admin/login');
    }
    public function forgot_password(){
         $title = trans('admin.Reset_password');
    	return view('admin.forgotPassword',['title'=>$title]);
    }
    public function reset_password(){
    	$admin = Admin::where('email', request('email'))->first();
    	if(!empty($admin)){
    		$token = app('auth.password.broker')->createToken($admin);
    		$data = \DB::table('password_resets')->insert([
	    		'email'=> $admin->email,
	    		'token'=> $token,
	    		'created_at' => Carbon::now(),
    		]);
    		Mail::to($admin->email)->send(new AdminResetPassword(['admin'=>$admin, 'token'=>$token]));
    		session()->flash('message',trans('admin.Check_Your_Email_To_Reset_Your_Passowrd'));
    		return back(); 
    	}else{
            session()->put('message',trans('admin.check_email'));
        }
    	return back(); 
    }
    public function new_password($token){
    	$remember_token = \DB::table('password_resets')->where('token', $token)->where('created_at','>',  Carbon::now()->subHours(2))->first();
    	if(!empty($remember_token)){
    		return view('admin.newPassword', ['admin'=>$remember_token]);
    	}else{
    		session()->flash('message',trans('admin.Sorry_The_Email_You_Entered_Is_Not_In_Our_DataBase_Or_Reset_Time_is_over'));
    		return redirect('admin/forgot/password');
    	}
    	
    }
    public function change_password($token){
    	$this->validate(request(),[
    		'password' => 'required|confirmed',
    		'password_confirmation' => 'required',
    	],[],[
    		'password' => 'Password',
    		'password_confirmation' => 'Confiramtion Password',
    	]);
    	$remember_token = \DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
    	if(!empty($remember_token)){	
	    	$admin = Admin::where('email',$remember_token->email)->update(['email'=>$remember_token->email, 'password'=>bcrypt(request('password'))]);
	    	\DB::table('password_resets')->where('email', $remember_token->email)->delete();
	    	auth()->guard('admin')->attempt(['email'=>$remember_token->email,'password' =>request('password') ], true);
    			return  redirect('admin');
    	}else{
    		session()->flash('message',trans('admin.Please_Check_Your_Email_Adress'));
    		return redirect('admin/forgot/password');
    	}

    }
}
