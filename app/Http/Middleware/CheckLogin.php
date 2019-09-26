<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
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
        $userLoged =  Auth::id();
        $route_name = $request->route()->getAction('as');


        if(!is_null($userLoged)){
            return $next($request);
        }else{
            return redirect()->route('login');
        }


    }
}
