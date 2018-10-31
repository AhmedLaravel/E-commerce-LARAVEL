<?php

namespace App\Http\Middleware;

use Closure;

class Users
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->guard('user')->user()){
            session()->flash('message',trans('admin.loginFirst'));
            return back();
        }else{
            return $next($request);
        }
    }
}
