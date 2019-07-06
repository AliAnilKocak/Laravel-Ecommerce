<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Manage
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
        //web.php içindeki middleware yönlendirmesi üzerinden aşağıda kontrolu yapmasını sağladık.
        if (Auth::guard('manage')->check() && Auth::guard('manage')->user()->is_admin == 1) {
            return $next($request);
        }else{
           return redirect()->route('manage.login');
        }
    }
}
