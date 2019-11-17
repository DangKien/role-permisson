<?php 
namespace DangKien\RolePer\Middleware;

/**
 * This file is part of DangKien\RolePer,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package DangKien\RolePer
 */

use Closure;
use Illuminate\Contracts\Auth\Guard;

class RolePerPermission
{
	const DELIMITER = '|';

	protected $auth;

	/**
	 * Creates a new instance of the middleware.
	 *
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  Closure $next
	 * @param  $permissions
	 * @return mixed
	 */
	public function handle($request, Closure $next, $permissions)
	{
        if (defined ('\App\User::ROOT_ACCOUNT') && @$this->auth->user()->email && in_array($this->auth->user()->email, \App\User::ROOT_ACCOUNT)) {
            return $next($request);
        }
		if (!is_array($permissions)) {
			$permissions = explode(self::DELIMITER, $permissions);
		}

		if ($this->auth->guest() || !$request->user()->can($permissions)) {
			abort(403);
		}

		return $next($request);
	}
}
