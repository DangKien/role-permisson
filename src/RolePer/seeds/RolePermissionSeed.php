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
        DB::table('users')->insert([
            'name'     => 'Dev Transoft',
            'email'    => 'dev@transoftvietnam.com',
            'password' =>  Hash::make('12345678'),
            'phone'    => '0123456789',
            'avatar'   => '1.png'
        ]);

        DB::table('roles')->insert([
            'name' => config('roleper.superadmin'),
            'display_name' => 'Super Admin',
            'description' => 'Super admin'
        ]);
        
        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1',
        ]);

        DB::table('permission_group')->insert([
            'name' => 'user',
            'display_name' => 'User Manager'
        ]);

        DB::table('permissions')->insert([
            ['name' => 'user.read', 'display_name' => 'Read', 'permission_group_id' => 1],
            ['name' => 'user.create', 'display_name' => 'Create', 'permission_group_id' => 1],
            ['name' => 'user.update', 'display_name' => 'Update', 'permission_group_id' => 1],
            ['name' => 'user.delete', 'display_name' => 'Delete', 'permission_group_id' => 1],
        ]);

        DB::table('permission_role')->insert([
            ['permission_id' => '1', 'role_id' => '1'],
            ['permission_id' => '2', 'role_id' => '1'],
            ['permission_id' => '3', 'role_id' => '1'],
            ['permission_id' => '4', 'role_id' => '1'],
        ]);



    }
}
