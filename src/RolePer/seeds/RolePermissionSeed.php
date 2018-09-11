<?php
namespace DangKien\Database\Seeds;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class RolePermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            'name'     => 'Dev Transoft',
            'email'    => 'dev@transoftvietnam.com',
            'password' =>  Hash::make('12345678'),
            'phone'    => '0123456789',
            'avatar'   => '1.png'
        ));

        DB::table('roles')->insert(array(
            'name' => config('roleper.superadmin'),
            'display_name' => 'Super Admin',
            'description' => 'Super admin'
        ));
        
        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1',
        ]);

        DB::table('permission_group')->insert(array(
            array( 'name' => 'user', 'display_name' => 'User Manager'),
            array( 'name' => 'role', 'display_name' => 'Role'),
            array( 'name' => 'user_permission', 'display_name' => 'Add permission'),
        ));

        DB::table('permissions')->insert(array (
            array('name' => 'user.read'  , 'display_name' => 'Read'  , 'permission_group_id' => 1),
            array('name' => 'user.create', 'display_name' => 'Create', 'permission_group_id' => 1),
            array('name' => 'user.update', 'display_name' => 'Update', 'permission_group_id' => 1),
            array('name' => 'user.delete', 'display_name' => 'Delete', 'permission_group_id' => 1),

            array('name' => 'role.read'  , 'display_name' => 'Read'  , 'permission_group_id' => 2),
            array('name' => 'role.create', 'display_name' => 'Create', 'permission_group_id' => 2),
            array('name' => 'role.update', 'display_name' => 'Update', 'permission_group_id' => 2),
            array('name' => 'role.delete', 'display_name' => 'Delete', 'permission_group_id' => 2),

            array('name' => 'permission.add_role', 'display_name' => 'Add permission for Role', 'permission_group_id' => 3),
            array('name' => 'permission.add_permission', 'display_name' => 'Add role User', 'permission_group_id' => 3),
        ));

        DB::table('permission_role')->insert(array(
            array('permission_id' => '1', 'role_id' => '1'),
            array('permission_id' => '2', 'role_id' => '1'),
            array('permission_id' => '3', 'role_id' => '1'),
            array('permission_id' => '4', 'role_id' => '1'),

            array('permission_id' => '5', 'role_id' => '1'),
            array('permission_id' => '6', 'role_id' => '1'),
            array('permission_id' => '7', 'role_id' => '1'),
            array('permission_id' => '8', 'role_id' => '1'),

            array('permission_id' => '9', 'role_id' => '1'),
            array('permission_id' => '10', 'role_id' => '1'),
        ));



    }
}
