<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next, $role)
{
    if (auth()->check() && auth()->user()->role === $role) {
        return $next($request);
    }

    // Optionally allow multiple roles, e.g., 'admin' or 'librarian'
    // $allowedRoles = explode('|', $role);
    // if (auth()->check() && in_array(auth()->user()->role, $allowedRoles)) { ... }

    abort(403, 'Unauthorized action.');
}
}
