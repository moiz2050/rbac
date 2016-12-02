<?php

namespace Moiz2050\Rbac\Middleware;

use Closure;
use Auth;
use Moiz2050\Rbac\Exceptions\PermissionDeniedException;

/**
 * Class VerifyPermission
 * @package Moiz2050\Rbac\Middleware
 */

class VerifyPermission
{
    /**
     * Handle an incoming request
     *
     * @param $request
     * @param Closure $next
     * @param $permission
     * @return mixed
     * @throws PermissionDeniedException
     */
    public function handle($request, Closure $next, $permission)
    {
        $guard = config('roles.guard.name');
        if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->can($permission)) {
            return $next($request);
        }

        throw new PermissionDeniedException($permission);
    }
}
