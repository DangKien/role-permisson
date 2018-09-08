<?php

namespace DangKien\RolePer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\PermissionGroup;
use App\Models\Permission;
use DB;

class PermissionGroupController extends Controller
{
    private $permissionGroupModel;
    private $permissionModel;

    public function __construct(PermissionGroup $permissionGroupModel, Permission $permissionModel)
    {
        $this->permissionGroupModel = $permissionGroupModel;
        $this->permissionModel      = $permissionModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("user_permission.permission_group.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user_permission.permission_group.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name'         => 'required|unique:permission_group',
            'display_name' => 'required|unique:permission_group',
        ));
        DB::beginTransaction();
        try {
            $this->permissionGroupModel->name         = $request->name;
            $this->permissionGroupModel->display_name = $request->display_name;
            $this->permissionGroupModel->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('permissions-group.index');
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
        $per_gr = $this->permissionGroupModel::findOrFail($id);
        return view("user_permission.permission_group.add", array("per_gr" => $per_gr));
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
            'name'         => "required|unique_rule:permission_group,$id",
            'display_name' => "required|unique_rule:permission_group,$id"
        ));
        DB::beginTransaction();
        try {
            $permissionGr               = $this->permissionGroupModel->findOrFail($id);
            $permissionGr->name         = $request->name;
            $permissionGr->display_name = $request->display_name;
            $permissionGr->save();
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('permissions-group.index');
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
            if ( $permissionGr = $this->permissionGroupModel::whereId($id) ) {
                $this->permissionModel->where('permission_group_id', $permissionGr->id)->delete();
                $permissionGr->delete();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        
        return redirect()->route('roles.index');
    }
}
