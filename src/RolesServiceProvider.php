<?php

namespace Moiz2050\Rbac;

use Illuminate\Support\ServiceProvider;
use Blade;

/**
 * Class RolesServiceProvider
 * @package Moiz2050\Rbac
 */
class RolesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBladeExtensions();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/roles.php', 'roles');
    }

    /**
     * Register Blade extensions.
     *
     * @return void
     */
    protected function registerBladeExtensions()
    {

        $guard = config('roles.guard.name');

        Blade::directive('role', function ($expression) use ($guard) {
            return "<?php if(Auth::guard('{$guard}')->check()&& Auth::guard('{$guard}')->user()->isRole({$expression})):?>";
        });

        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('permission', function ($expression) use ($guard) {
            return "<?php if (Auth::guard('{$guard}')->check() && Auth::guard('{$guard}')->user()->can({$expression})): ?>";
        });

        Blade::directive('endpermission', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('level', function ($expression) use ($guard) {
            $level = trim($expression, '()');

            return "<?php if (Auth::guard('{$guard}')->check() && Auth::guard('{$guard}')->user()->level() >= {$level}):?>";
        });

        Blade::directive('endlevel', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('allowed', function ($expression) use ($guard) {
            return "<?php if(Auth::guard('{$guard}')->check() && Auth::guard('{$guard}')->user()->allowed{$expression}):?>";
        });

        Blade::directive('endallowed', function () {
            return "<?php endif; ?>";
        });
    }
}
