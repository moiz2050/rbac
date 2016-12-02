<?php

namespace Moiz2050\Rbac\Middleware;

use Closure;
use Auth;
use Moiz2050\Rbac\Exceptions\LevelDeniedException;

/**
 * Class VerifyLevel
 * @package Moiz2050\Rbac\Middleware
 */
class VerifyLevel
{
    /**
     * Handle an incoming request
     *
     * @param $request
     * @param Closure $next
     * @param $level
     * @return mixed
     * @throws LevelDeniedException
     */
    public function handle($request, Closure $next, $level)
    {
        $guard = config('roles.guard.name');
        if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->level() >= $level) {
            return $next($request);
        }

        throw new LevelDeniedException($level);
    }
}
