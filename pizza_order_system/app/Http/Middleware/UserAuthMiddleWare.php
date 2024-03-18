<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(Auth::user())){

            if(Auth::user()->role =='admin'){
                abort(404);
            }
            if(url()->current()  == route('auth#loginPage') ||  url()->current()  == route('auth#registerPage')){
                // return back();
                return view('user#home');
            }
            return $next($request);
        }
        return $next($request);

    }
}
