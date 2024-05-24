<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CloudFrontProxies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $headers = $request->headers;
        $referer = $headers->get('referer');
        $appUrl = config("app.url");
        if ($referer) {
            $referer = parse_url($referer);
            $newPrefer = $appUrl . $referer['path'];
            $headers->add(['referer' => $newPrefer]);
        } else {
            $headers->add(['referer' => $appUrl]);
        }

        return $next($request);
    }
}
