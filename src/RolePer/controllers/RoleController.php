<?php

namespace DangKien\RolePer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Permission;
use App\Models\Role;
use DB, Auth;

class RoleController extends Controller
{
    private $roleModel;

    public function __construct(Role $roleModel)
    {
        $this->roleModel      = $roleModel;
    }

    public function index() {

        return view("user_permission.role.index");
    }
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
    public function create() {
        return view("user_permission.role.add");
    }
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
    public function store(Request $request) {
        $this->validate($request, array(
            'name'         => 'required|unique:roles',
            'display_name' => 'required|unique:roles',
        ));
        $role = new Role();
        DB::beginTransaction();
        try {
            $this->roleModel->name         = $request->name;
            $this->roleModel->display_name = $request->display_name;
            $this->roleModel->description  = $request->description;
            $this->roleModel->save();
            DB::commit();
            return redirect()->route('roles.index')->with(['role' => trans('backend.role.actions_create_success')]);
        } catch (Exception $e) {
            DB::rollback();
        }
    }
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {   
            $role = Role::findOrFail($id);
            if ($role->name == config('roleper.superadmin') && Auth::check() && !Auth::user()->hasRole(config('roleper.superadmin')) ) {
                return abort(403);
            }
            return view("user_permission.role.add", array("role" => $role));
        }
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $this->validate($request, array(
                'name'         => "required|unique_rule:roles,$id",
                'display_name' => "required|unique_rule:roles,$id"
            ));
            DB::beginTransaction();
            try {
                $role               = $this->roleModel->findOrFail($id);
                if ($role->name == config('roleper.superadmin') && Auth::check() && !Auth::user()->hasRole(config('roleper.superadmin')) ) {
                    return abort(403);
                }
                $role->name         = $request->name;
                $role->display_name = $request->display_name;
                $role->description  = $request->description;
                $role->save();
                DB::commit();
                return redirect()->route('roles.index')->with(['role' => trans('backend.role.actions_update_success')]);
            } catch (Exception $e) {
                DB::rollback();
            }
            
        }
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            DB::beginTransaction();
            try {
                $role = $this->roleModel::where('id', $id)->first();
                if (!empty($role) && @$role->name != config('roleper.superadmin')) {
                    $role->delete();
                }
                DB::commit();
                return redirect()->route('roles.index')->with(['role' => trans('backend.role.actions_delete_success')]);
            } catch (Exception $e) {
                DB::rollback();
            }
            
        }
}
