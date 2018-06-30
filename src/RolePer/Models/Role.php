<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DangKien\RolePer\RolePerRole;

class Role extends RolePerRole
{
    protected $table='roles';

    public function permission_role()
    {
        return $this->belongsToMany('App\Models\Permission', "permission_role", "role_id", "permission_id");
    }
}
