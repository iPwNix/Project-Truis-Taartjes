<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminMiddleware
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
        if (Auth::guest() || $request->user()->roleID != 2)
        {
            return redirect('home');
        }

        return $next($request);
    }
}
