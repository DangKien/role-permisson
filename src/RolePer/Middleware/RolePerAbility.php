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

class RolePerAbility
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
	 * @param \Illuminate\Http\Request $request
	 * @param Closure $next
	 * @param $roles
	 * @param $permissions
	 * @param bool $validateAll
	 * @return mixed
	 */
	public function handle($request, Closure $next, $roles, $permissions, $validateAll = false)
	{
		if (@User::ROOT_ACOUNT && @$this->auth->user()->email && in_array($this->auth->user()->email, User::ROOT_ACOUNT)) {
			return $next($request);
		}
		if (!is_array($roles)) {
			$roles = explode(self::DELIMITER, $roles);
		}

		if (!is_array($permissions)) {
			$permissions = explode(self::DELIMITER, $permissions);
		}

		if (!is_bool($validateAll)) {
			$validateAll = filter_var($validateAll, FILTER_VALIDATE_BOOLEAN);
		}

		if ($this->auth->guest() || !$request->user()->ability($roles, $permissions, [ 'validate_all' => $validateAll ])) {
			abort(403);
		}

		return $next($request);
	}
}
