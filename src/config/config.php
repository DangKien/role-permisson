<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | This is the Role model used by DangKien\RolePer to create correct relations.  Update
    | the role if it is in a different namespace.
    |
    */
    'role' => 'App\Models\Role',

    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | This is the roles table used by DangKien\RolePer to save roles to the database.
    |
    */
    'roles_table' => 'roles',

    /*
    |--------------------------------------------------------------------------
    |
    |--------------------------------------------------------------------------
    |
    | This is the role foreign key used by DangKien\RolePer to make a proper
    | relation between permissions and roles & roles and users
    |
    */
    'role_foreign_key' => 'role_id',

    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | This is the User model used by DangKien\RolePer to create correct relations.
    | Update the User if it is in a different namespace.
    |
    */
    'user' => 'App\User',

    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | This is the users table used by the application to save users to the
    | database.
    |
    */
    'users_table' => 'users',

    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by DangKien\RolePer to save assigned roles to the
    | database.
    |
    */
    'role_user_table' => 'role_user',

    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | This is the user foreign key used by DangKien\RolePer to make a proper
    | relation between roles and users
    |
    */
    'user_foreign_key' => 'user_id',

    /*
    |--------------------------------------------------------------------------
    |
    |--------------------------------------------------------------------------
    |
    | This is the Permission model used by DangKien\RolePer to create correct relations.
    | Update the permission if it is in a different namespace.
    |
    */
    'permission' => 'App\Models\Permission',

    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | This is the permissions table used by DangKien\RolePer to save permissions to the
    | database.
    |
    */
    'permissions_table' => 'permissions',

    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | This is the permission_role table used by DangKien\RolePer to save relationship
    | between permissions and roles to the database.
    |
    */
    'permission_role_table' => 'permission_role',

    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | This is the permission foreign key used by DangKien\RolePer to make a proper
    | relation between permissions and roles
    |
    */
    'permission_foreign_key' => 'permission_id',
	
	'superadmin' => 'superadmin',
];
