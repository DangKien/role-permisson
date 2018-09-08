<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $table = 'permission_group';

    public function permissions() {
    	return $this->hasMany('App\Models\Permission', 'permission_group_id', 'id');
    }
}
