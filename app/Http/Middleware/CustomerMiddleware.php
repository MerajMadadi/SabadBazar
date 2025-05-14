<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*just customer can skip this*/
        $user = Auth::user();
        if ($user) {
            if ($user->roles()->first()->name == 'فروشنده') {
                abort(403, 'دسترسی غیر مجاز');
            } else {
                return $next($request);
            }
        } else {
            return redirect('/login');
        }
    }
}
