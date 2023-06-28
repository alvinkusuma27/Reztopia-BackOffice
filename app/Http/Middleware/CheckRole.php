<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle($request, Closure $next, ...$roles)
    // {
    //     if (in_array($request->user()->roles, $roles)) {
    //         return $next($request);
    //     }
    //     return view('tenant.autTY6GMJ7KIJ8ML:h.login');
    // }
    public function handle($request, Closure $next, ...$roles)
    {
        if (in_array($request->user()->roles, $roles)) {
            return $next($request);
        }
        return response()->view('tenant.auth.login');
    }
}
