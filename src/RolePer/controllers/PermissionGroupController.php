<?php

namespace DangKien\RolePer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\PermissionGroup;

class PermissionGroupController extends Controller
{
    private $permissionGroupModel;
    public function __construct(PermissionGroup $permissionGroupModel)
    {
        $this->permissionGroupModel = $permissionGroupModel;
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
        $this->permissionGroupModel->name         = $request->name;
        $this->permissionGroupModel->display_name = $request->display_name;
        $this->permissionGroupModel->save();

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
        $permissionGr = $this->permissionGroupModel->findOrFail($id);
        $permissionGr->name         = $request->name;
        $permissionGr->display_name = $request->display_name;
        $permissionGr->save();
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
        //
    }
}
