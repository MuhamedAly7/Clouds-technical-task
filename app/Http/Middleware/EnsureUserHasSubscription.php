<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->subscribedToPrice(env('MONTHLY_PLAN_ID'), env('PRODUCT_ID')) || $request->user()?->subscribedToPrice(env('YEARLY_PLAN_ID'), env('PRODUCT_ID'))) {
            return $next($request);
        }
        return redirect()->route('pricing')->with('error', 'You need to subscribe with any plan to access the dashboard.');

    }
}
