<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use App\User;
use App\Mail\UserResetPassword;
use Auth;
use \App\Models\Currency;
use Mail;
use Swap;
use Illuminate\Http\Request;
use Carbon\Carbon;
class usersAuth extends Controller
{
    public function login_user(){
        $title = trans('admin.login_title_user');
    	return view('admin.loginUser' ,['title' => $title]);
    } 
    public function do_login(){
    	$remember = request('rememberme') == 1? true: false;
    	if(Auth::guard('user')->attempt(['email'=>request('email'),'password' =>request('password') ], $remember)){
            ////////////Currency Exchange////////////////
            Currency::where('code','EGP')->update(['exchange_rate'=>1]);
            Currency::where('code','USD')->update(['exchange_rate'=>(1/settings()->dollar_egypt)]);
            Currency::where('code','EUR')->update(['exchange_rate'=>(1/settings()->euro_egypt)]);
            ////////////Currency Exchange////////////////
    		return  redirect('/');
    	}else{
    		return redirect('users/login');
    	}
    }
    public function do_logout(){
    	auth()->guard('user')->logout();
    	return redirect(url('/'));
    }
    public function forgot_password(){
        $title = trans('admin.Reset_password_user');
    	return view('admin.forgotPasswordUser', ['title'=>$title]);
    }
    public function reset_password(){
    	$user = User::where('email', request('email'))->first();
    	if(!empty($user)){
    		$token = app('auth.password.broker')->createToken($user);
    		$data = \DB::table('password_resets')->insert([
	    		'email'=> $user->email,
	    		'token'=> $token,
	    		'created_at' => Carbon::now(),
    		]);
    		Mail::to($user->email)->send(new UserResetPassword(['user'=>$user, 'token'=>$token]));
    		session()->flash('message',trans('admin.Check_Your_Email_To_Reset_Your_Passowrd'));
    		return back(); 
    	}
    	return back(); 
    }
    public function new_password($token){
    	$remember_token = \DB::table('password_resets')->where('token', $token)->where('created_at','>',  Carbon::now()->subHours(2))->first();
    	if(!empty($remember_token)){
    		return view('admin.newPasswordUser', ['user'=>$remember_token]);
    	}else{
    		session()->flash('message',trans('admin.Sorry_The_Email_You_Entered_Is_Not_In_Our_DataBase_Or_Reset_Time_is_over'));
    		return redirect('users/forgot/password');
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
	    	$admin = User::where('email',$remember_token->email)->update(['email'=>$remember_token->email, 'password'=>bcrypt(request('password'))]);
	    	\DB::table('password_resets')->where('email', $remember_token->email)->delete();
	    	auth()->guard('user')->attempt(['email'=>$remember_token->email,'password' =>request('password') ], true);
    			return  redirect(url('/'));
    	}else{
    		session()->flash('message',trans('admin.Please_Check_Your_Email_Adress'));
    		return redirect(uurl('forgot/password'));
    	}

    }
}
