<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanAccessIncidents
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'incident') {
            // Redirige vers la page tarifs avec un message
            return redirect()->route('tarifs')->with('upgrade', true);
        }

        return $next($request);
    }
}
