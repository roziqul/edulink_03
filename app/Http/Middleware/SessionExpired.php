<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionExpired
{
    public function handle($request, Closure $next)
    {
        // Exclude the login and logout routes from session checking to prevent redirect loop
        if ($request->routeIs('login') || $request->routeIs('logout')) {
            return $next($request);
        }

        if (!Session::has('lastActivityTime')) {
            Session::put('lastActivityTime', now());
        } elseif (now()->diffInMinutes(Session::get('lastActivityTime')) > config('session.lifetime')) {
            Auth::logout();
            Session::flush();
            return redirect()->route('login')->withErrors(['Your session has expired. Please login again.']);
        }

        Session::put('lastActivityTime', now());

        return $next($request);
    }
}


