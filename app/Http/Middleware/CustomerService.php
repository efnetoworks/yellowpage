<?php

namespace App\Http\Middleware;

use Closure;

class CustomerService
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
         if (Auth::check() && Auth::user()->role == 'customerservice' ) {
            return $next($request);
        }  else {
            return redirect()->route('home');
        }
    }
}
