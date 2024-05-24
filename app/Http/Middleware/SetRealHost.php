<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetRealHost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('X-Forwarded-Host')) {
            $request->headers->set('Host', $request->header('X-Forwarded-Host'));
        }
        if ($request->header('X-Forwarded-Proto')) {
            $request->headers->set('X-Forwarded-Proto', $request->header('X-Forwarded-Proto'));
        }

        return $next($request);
    }
}
