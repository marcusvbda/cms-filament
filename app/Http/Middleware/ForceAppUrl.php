<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use URL;

class ForceAppUrl
{
    public function handle(Request $request, Closure $next): Response
    {
        $url = config('app.url');
        URL::forceRootUrl($url);
        return $next($request);
    }
}
