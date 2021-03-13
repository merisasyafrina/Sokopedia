<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::check() && Auth::user()->role == 0){
                return redirect(RouteServiceProvider::HOME);
            }else if(Auth::check() && Auth::user()->role == 1){
                return redirect(RouteServiceProvider::ADMINPANEL);
            }
            
        }

        return $next($request);
    }
}
