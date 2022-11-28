<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Employee
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role_id == 2) {
            return $next($request);
        }

        $destinations = [
            1 => 'admin',
            3 => 'leader'
            
        ];

        return redirect(route($destinations[Auth::user()->role_id]));
    }
}
