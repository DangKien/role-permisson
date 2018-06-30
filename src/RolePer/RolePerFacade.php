<?php 
namespace DangKien\RolePer;

/**
 * This file is part of DangKien\RolePer,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package DangKien\RolePer
 */

use Illuminate\Support\Facades\Facade;

class RolePerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'roleper';
    }
}
