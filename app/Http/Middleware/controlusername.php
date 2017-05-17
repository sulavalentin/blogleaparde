<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class controlusername
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
        if(Session::has('username')){
            return redirect('/getusername');
        }
        return $next($request);
    }
}
