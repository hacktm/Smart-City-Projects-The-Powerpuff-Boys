<?php namespace SpreadOut\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;

class AccessMiddleware implements Middleware {

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'X-Requested-With, content-type, Authorization');

        return $response;
    }
}
