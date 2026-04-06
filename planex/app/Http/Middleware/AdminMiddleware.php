<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (!auth()->user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'Accès refusé');
        }

        return $next($request); // ✅ IMPORTANT
    }
}