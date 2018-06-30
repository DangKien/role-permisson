<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DangKien\RolePer\RolePerPermission;

class Permission extends RolePerPermission
{
    protected $table = 'permissions';

    public function permission_group() {
    	return $this->belongsTo('App\Models\PermissionGroup', 'permission_group_id', 'id');
    }
}
