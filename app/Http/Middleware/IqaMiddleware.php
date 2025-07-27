<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IqaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'iqa' role
        // if (!Auth::user() || Auth::user()->user_type !== 'iqa') {
        //     // Redirect to the login page or show an unauthorized response
        //     return redirect()->route('login')->with('error', 'You do not have access to this section.');
        // }
        // return $next($request);

        if (Auth::check() && Auth::user()->user_type === 'iqa') {
            return $next($request);
        }
        abort(403, 'Unauthorized access to this section.');
    }
}
