<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect based on user role
        if ($request->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // return redirect()->route('dashboard');
        if ($request->user()?->subscribedToPrice(env('MONTHLY_PLAN_ID'), env('PRODUCT_ID')) || $request->user()?->subscribedToPrice(env('YEARLY_PLAN_ID'), env('PRODUCT_ID'))) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('pricing');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}