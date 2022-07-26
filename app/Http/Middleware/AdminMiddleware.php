<?php

namespace App\Http\Middleware;

use App\MyServices\Roles;
use Closure;
use Illuminate\Support\Facades\Auth;

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
		if(Auth::user()->roles != Roles::ADMIN)
		{
			abort(404);
		}
        return $next($request);
    }
}
