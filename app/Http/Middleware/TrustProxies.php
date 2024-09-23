<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class TrustProxies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        // Trust proxies logic if applicable
        return $next($request);
    }
}
