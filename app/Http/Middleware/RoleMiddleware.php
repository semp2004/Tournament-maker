<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();

        if (! $user)
            abort(403);

        if ($user->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
