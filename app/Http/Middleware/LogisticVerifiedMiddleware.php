<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class LogisticVerifiedMiddleware
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
        if (Auth::guard('logistic')->check()) {
            //Check login

            //check if user is verified
            if(Auth::guard('logistic')->user()->is_verified == 1)
            {
                return $next($request);
            }

            return redirect()->route('logistic.not.verified');
        }
        
    }
}
