<?php

namespace Moiz2050\Rbac\Middleware;

use Closure;
use Auth;
use Moiz2050\Rbac\Exceptions\RoleDeniedException;

/**
 * Class VerifyRole
 * @package Moiz2050\Rbac\Middleware
 */
class VerifyRole
{
    /**
     * Handle an incoming request
     *
     * @param $request
     * @param Closure $next
     * @param $role
     * @return mixed
     * @throws RoleDeniedException
     */
    public function handle($request, Closure $next, $role)
    {
        $guard = config('roles.guard.name');
        if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->isRole($role)) {
            return $next($request);
        }

        throw new RoleDeniedException($role);
    }
}
