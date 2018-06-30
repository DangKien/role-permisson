<?php 
namespace DangKien\RolePer\Contracts;

/**
 * 
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package DangKien\RolePer
 */

interface RolePerPermissionInterface
{

    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
}
