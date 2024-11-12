<?php

namespace App\Http\Middleware;

use App\Enums\User\RoleEnum;
use Closure;
use Illuminate\Http\Request;

/**
 * Middleware to check if the user is an admin
 */
class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role !== RoleEnum::ADMIN->value) {
            return redirect()->route('home')->with('error', 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
