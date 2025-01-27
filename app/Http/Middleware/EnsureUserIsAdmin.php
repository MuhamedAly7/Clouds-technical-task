<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            if ($request->user()?->subscribedToPrice(env('MONTHLY_PLAN_ID'), env('PRODUCT_ID')) || $request->user()?->subscribedToPrice(env('YEARLY_PLAN_ID'), env('PRODUCT_ID'))) {
                return redirect()->route('dashboard');
            }
            return redirect()->route('pricing');
        }

        return $next($request);
    }
}
