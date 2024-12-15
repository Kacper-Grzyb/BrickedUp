<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InactivityLogout
{
    public function handle($request, Closure $next)
    {
        // if (Auth::check()) {
        //     $lastActivity = session('last_activity_time');

        //     if ($lastActivity && now()->diffInMinutes($lastActivity) >= config('session.lifetime')) {
        //         Auth::logout();
        //         session()->invalidate();
        //         session()->regenerateToken();

        //         return redirect()->route('login')->with('message', 'You have been logged out due to inactivity.');
        //     }

        //     session(['last_activity_time' => now()]);
        // }

        // return $next($request);
        // Set the maximum inactivity time in minutes
        $maxInactivityTime = 1;  // 1 minute

        if (Session::has('last_activity') && time() - Session::get('last_activity') > $maxInactivityTime * 60) {
            // Logout if inactive for too long
            Auth::logout();
            Session::flush();
            return redirect('/login');
        }

        // Update last activity time
        Session::put('last_activity', time());

        return $next($request);
    }
}
