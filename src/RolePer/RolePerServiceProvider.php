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
use Validator, DB;

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
            __DIR__.'/../config/config.php'         => base_path('config/roleper.php'),
            __DIR__.'/migrations'                   => base_path('database/migrations'),
            __DIR__.'/seeds'                        => base_path('database/seeds'),
            __DIR__.'/Models/DkPermission.php'      => base_path('app/Models/Permission.php'),
            __DIR__.'/Models/DkPermissionGroup.php' => base_path('app/Models/PermissionGroup.php'),
            __DIR__.'/Models/DkRole.php'            => base_path('app/Models/Role.php'),
            __DIR__.'/Middleware'                   => base_path('app/Http/Middleware'),
            __DIR__.'/../views/role_per'            => base_path('resources/views/user_permission'),
        ]);
        $this->bladeDirectives();
        Validator::extend('unique_rule', function($attribute, $value, $parameters, $validator) {
            $exit = DB::table($parameters[0])->where([ 
                                        array($attribute, $value),
                                        array('id', '!=', $parameters[1])
                                    ])->first();
            if (empty($exit) ) {
                return true;
            }
            return false;
        });

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
