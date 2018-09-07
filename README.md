# RolePermission
Role-Permission Laravel Packget


## Installation

1)Just add the following to your composer.json. Then run `composer update`:

```json
composer update dangkien/roleper --no-scripts
```

2) Open your `config/app.php` and add the following to the `providers` array:

```php
DangKien\RolePer\RolePerServiceProvider::class,
```

3) In the same `config/app.php` and add the following to the `aliases ` array: 

```php
'RolePer'   => DangKien\RolePer\RolePerFacade::class,
```

4) Run the command below to publish the package config file `config/roleper.php`:

```shell
php artisan vendor:publish
```

5)  If you want to use [Middleware](#middleware) (requires Laravel 5.1 or later) you also need to add the following:

```php
    'role' => \DangKien\RolePer\Middleware\RolePerRole::class,
    'permission' => \DangKien\RolePer\Middleware\RolePerPermission::class,
    'ability' => \DangKien\RolePer\Middleware\RolePerAbility::class,
```

to `routeMiddleware` array in `app/Http/Kernel.php`.


#### Checking for Roles & Permissions

Now we can check for roles and permissions simply by doing:

```php
$user->hasRole('owner');   // false
$user->hasRole('admin');   // true
$user->can('edit-user');   // false
$user->can('create-post'); // true
```

Both `hasRole()` and `can()` can receive an array of roles & permissions to check:

```php
$user->hasRole(['owner', 'admin']);       // true
$user->can(['edit-user', 'create-post']); // true
```

By default, if any of the roles or permissions are present for a user then the method will return true.
Passing `true` as a second parameter instructs the method to require **all** of the items:

```php
$user->hasRole(['owner', 'admin']);             // true
$user->hasRole(['owner', 'admin'], true);       // false, user does not have admin role
$user->can(['edit-user', 'create-post']);       // true
$user->can(['edit-user', 'create-post'], true); // false, user does not have edit-user permission
```

You can have as many `Role`s as you want for each `User` and vice versa.

### Route
```php
/// ROLE PERMISSION ROUTE
    Route::resource('roles', '\DangKien\RolePer\Controllers\RoleController');

    Route::resource('permissions', '\DangKien\RolePer\Controllers\PermissionController');

    Route::resource('permissions-group', '\DangKien\RolePer\Controllers\PermissionGroupController');

    Route::get('user-permission/{id}', '\DangKien\RolePer\Controllers\UserRoleController@index')->name('user-permission.index');
    Route::post('user-permission/{id}', '\DangKien\RolePer\Controllers\UserRoleController@store')->name('user-permission.store');

    Route::get('role-permission/{id}', '\DangKien\RolePer\Controllers\RolePermissionController@index')->name('roles-permission.index');
    Route::post('role-permission/{id}', '\DangKien\RolePer\Controllers\RolePermissionController@store')->name('roles-permission.store');
```

### User

Next, use the `RolePerUserTrait` trait in your existing `User` model. For example:

```php
<?php

use DangKien\RolePer\Traits\RolePerUserTrait;

class User extends Eloquent
{
    use RolePerUserTrait; // add this trait to your user model

    ...
}

### Middleware

You can use a middleware to filter routes and route groups by permission or role
```php
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::get('/', 'AdminController@welcome');
    Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
```

It is possible to use pipe symbol as *OR* operator:
```php
'middleware' => ['role:admin|root']
```

To emulate *AND* functionality just use multiple instances of middleware
```php
'middleware' => ['role:owner', 'role:writer']
```

For more complex situations use `ability` middleware which accepts 3 parameters: roles, permissions, validate_all
```php
'middleware' => ['ability:admin|owner,create-post|edit-user,true']
```


