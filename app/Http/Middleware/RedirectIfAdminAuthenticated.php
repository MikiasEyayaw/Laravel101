<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Debug: Log admin authentication status
        \Log::info('Admin middleware check', [
            'admin_authenticated' => Auth::guard('admin')->check(),
            'user_authenticated' => Auth::guard('web')->check(),
            'session_id' => session()->getId(),
            'url' => $request->fullUrl()
        ]);

        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // If admin is not authenticated, redirect to admin login
        \Log::error('Admin not authenticated, redirecting to login');
        return redirect()->route('admin.login');
    }
}
