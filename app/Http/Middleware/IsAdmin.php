<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if (auth()->user()->role == 'admin') {
            return $next($request);
        }elseif (auth()->user()->role == 'author') {
//            return redirect()->route("home")->with("toast","Student Login Successful");
            return redirect('author-home');  // member dashboard path
        }else{
            return redirect('home');
        }
    }
}
