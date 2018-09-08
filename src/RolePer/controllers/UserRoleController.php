<?php

namespace DangKien\RolePer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Role;
use DB, Auth;

class UserRoleController extends Controller
{
	private $userModel;
    public function __construct(User $userModel)
    {
    	$this->userModel = $userModel;
        // $this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {	
    	$user = $this->userModel->with("roles")->findOrFail($id);
        if (!Auth::user()->hasRole(config('roleper.superadmin')) && $user->hasRole(config('roleper.superadmin')) ) {
            return redirect()->back();
        }
    	return view("user_permission.user_role.index", array('user'=>$user));
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
    public function store(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $role_spad = Role::where('name', config('roleper.superadmin'))->first();
            $roles = isset($request->roles) ? $request->roles : array();
            if ($user->hasRole(config('roleper.superadmin'))) {
                if (!in_array($role_spad->id, $roles)) {
                    return redirect()->back()->withInput()->withErrors(['roles' => trans('backend.validate.error_user_role')]);
                }
            }
            $user->roles()->sync($roles);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
		
		return redirect()->route('users.index')->with('users', 'success');
    }
}
