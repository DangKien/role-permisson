<?php

namespace DangKien\RolePer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Role;
use DB, Auth;

class RolePermissionController extends Controller
{
    private $roleModel;
    public function __construct(Role $roleModel)
    {
        $this->roleModel = $roleModel;

        $this->middleware('permission:permission.add_permission', ['only' => ['index']]);
        $this->middleware('permission:permission.add_permission', ['only' => ['store']]);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role_id)
    {
    	$role = $this->roleModel::with('permission_role')->findOrFail($role_id);

        if ($role->name == config('roleper.superadmin') && Auth::check() && !Auth::user()->hasRole(config('roleper.superadmin'))) {
            return abort(403);
        }

        return view("user_permission.role.permission.index", array("role" => $role));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $role_id)
    {
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($role_id);
            if (isset($request->permission) && count($request->permission)) {
                $role->permission_role()->sync($request->permission);
            }
            else {
                $role->permission_role()->sync(array());
            }

            $role->save();    
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    	
		return redirect()->route('roles.index')->with(['role' => trans('backend.role.actions_create_success')]);
    }

}
