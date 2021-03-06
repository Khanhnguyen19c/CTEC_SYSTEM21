<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->utype === 'Teacher')
        {
            return $next($request);
        }else{
            // session()->flush();
            return redirect()->intended('404'); //not Teacher no login
        }
        return $next($request);
    }
}
