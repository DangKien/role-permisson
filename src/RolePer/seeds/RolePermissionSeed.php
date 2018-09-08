<?php
namespace DangKien\Database\Seeds;

use Illuminate\Database\Seeder;
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
			'email'    => 'dev.transoft@gmail.com',
			'password' =>  Hash::make('123456'),
			'phone'    => '0123456789',
			'avatar'   => '1.png'
        ]);

        DB::table('roles')->insert([
            'name' => config('roleper.superadmin'),
            'display_name' => 'Super Admin',
            'desciprion' => 'Super admin'
        ]);

        DB::table('roles')->insert([
            'name' => config('roleper.superadmin'),
            'display_name' => 'Super Admin',
            'desciprion' => 'Super admin'
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
            ['name' => 'user.read', 'display_name' => 'Read'],
            ['name' => 'user.create', 'display_name' => 'Create'],
            ['name' => 'user.update', 'display_name' => 'Update'],
            ['name' => 'user.delete', 'display_name' => 'Delete'],
        ]);

        DB::table('permission_role')->insert([
            ['permission_id' => '1', 'role_id' => '1'],
            ['permission_id' => '2', 'role_id' => '1'],
            ['permission_id' => '3', 'role_id' => '1'],
            ['permission_id' => '4', 'role_id' => '1'],
        ]);



    }
}
