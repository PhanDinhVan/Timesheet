<?php

namespace App\Http\Middleware;

use Closure;

// import thu vien nay dung de login
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
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
        if(Auth::check()){
            $user = Auth::user();
            if($user->position  == 1){
                return $next($request);
            }
            else{
                return redirect('login');
            }
        }
        else{
            return redirect('login');
        }
    }
}
