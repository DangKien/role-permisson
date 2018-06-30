<?php 
namespace DangKien\RolePer;

/**
 * This file is part of DangKien\RolePer,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package DangKien\RolePer
 */

use DangKien\RolePer\Contracts\RolePerPermissionInterface;
use DangKien\RolePer\Traits\RolePerPermissionTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class RolePerPermission extends Model implements RolePerPermissionInterface
{
    use RolePerPermissionTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('roleper.permissions_table');
    }

}
