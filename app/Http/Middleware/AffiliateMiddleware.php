<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;


class AffiliateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('aff-user')) {
            // Set a cookie for the affiliate user for the current session only
            Cookie::queue('affiliate_user', $request->input('aff-user'), 0);
        }

        return $next($request);
    }
}
