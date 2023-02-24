<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        foreach ($roles as $role) {
            if ($user->hasRole($role)) return $next($request);
        }
        throw new AccessDeniedHttpException("you don't have permission to this route");
    }
}
