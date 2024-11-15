<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next, $guard = null)
    {
        // Check if the user is authenticated for the specified guard
        $guards = empty($guard) ? [null] : [$guard];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return Redirect::guest('dashboard'); // Redirect to 'dashboard'
            }
        }

        return $next($request);
    }
    

}
