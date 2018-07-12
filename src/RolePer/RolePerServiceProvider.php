<?php 
namespace DangKien\RolePer;

/**
 * This file is part of DangKien,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package DangKien\RolePer
 */

use Illuminate\Support\ServiceProvider;

class RolePerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/config.php' => app()->basePath() . '/config/roleper.php',
            __DIR__.'/migrations' => base_path('database/migrations'),
            __DIR__.'/Models' => base_path('app/Models'),
            __DIR__.'/Middleware' => base_path('app/Http/Middleware'),
            __DIR__.'/../views/role_per' => base_path('resources/views/user_permission'),
        ]);
        $this->bladeDirectives();

        // $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('DangKien\RolePer\Controllers\RoleController');
        $this->app->make('DangKien\RolePer\Controllers\PermissionGroupController');
        $this->app->make('DangKien\RolePer\Controllers\PermissionController');
        $this->app->make('DangKien\RolePer\Controllers\UserRoleController');
        $this->app->make('DangKien\RolePer\Controllers\RolePermissionController');
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        if (!class_exists('\Blade')) return;

        \Blade::directive('role', function($expression) {
            return "<?php if (\\DangKien::hasRole({$expression})) : ?>";
        });

        \Blade::directive('endrole', function($expression) {
            return "<?php endif; // DangKien::hasRole ?>";
        });

        \Blade::directive('permission', function($expression) {
            return "<?php if (\\DangKien::can({$expression})) : ?>";
        });

        \Blade::directive('endpermission', function($expression) {
            return "<?php endif; // DangKien::can ?>";
        });

        \Blade::directive('ability', function($expression) {
            return "<?php if (\\DangKien::ability({$expression})) : ?>";
        });

        \Blade::directive('endability', function($expression) {
            return "<?php endif; // DangKien::ability ?>";
        });
    }
}
