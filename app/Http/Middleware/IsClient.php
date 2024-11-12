<?php

namespace App\Http\Middleware;

use App\Enums\User\RoleEnum;
use Closure;
use Illuminate\Http\Request;

/**
 * Middleware to check if the user is a client
 */
class IsClient
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role !== RoleEnum::CLIENT->value) {
            return redirect()->route('home')->with('error', 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
