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
        $cloudfrontProto = $headers->get('cloudfront-forwarded-proto');
        if ($cloudfrontProto) {
            dd("teemmm");
            $headers->add(['x-forwarded-proto' => $cloudfrontProto]);
        }
        return $next($request);
    }
}
