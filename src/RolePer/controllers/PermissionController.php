<?php

namespace DangKien\RolePer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Permission;
use DB;

class PermissionController extends Controller
{   
    private $permissionModel;
    public function __construct(Permission $permissionModel)
    {
        $this->permissionModel = $permissionModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("user_permission.permission.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user_permission.permission.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
            $this->validate($request, array(
                'name'         => 'required|unique:permissions',
                'display_name' => 'required',
            ));
            DB::beginTransaction();
            try {
                $this->permissionModel->name                = $request->name;
                $this->permissionModel->display_name        = $request->display_name;
                $this->permissionModel->description         = $request->description;
                $this->permissionModel->permission_group_id = $request->per_gr;
                $this->permissionModel->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
            return redirect()->route('permissions.index');
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
        $this->validate($request, array(
            'name'         => "required|unique_rule:permissions,$id",
            'display_name' => "required"
        ));
        $permission = $this->permissionModel::with('permission_group')
                                            ->findOrFail($id);   
        return view("user_permission.permission.add", array("permission" => $permission));
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
        DB::beginTransaction();
        try {
            $permission = $this->permissionModel->findOrFail($id);
            $permission->name                = $request->name;
            $permission->display_name        = $request->display_name;
            $permission->description         = $request->description;
            $permission->permission_group_id = $request->per_gr;
            $permission->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('permissions.index');
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
            if ($permission = $this->permissionModel::whereId($id)) {
                $permission->delete();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        
        
        return redirect()->route('permissions.index');
    }
}
