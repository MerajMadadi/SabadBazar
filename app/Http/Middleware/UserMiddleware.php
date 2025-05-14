<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*just user(registered or not) can skip this*/
        if (auth()->check()) {
            if (auth()->user()->roles()->first()->name == 'فروشنده') {
                abort(403, 'دسترسی غیر مجاز');
            }
        }
        return $next($request);
    }
}
