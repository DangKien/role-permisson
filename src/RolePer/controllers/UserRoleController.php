<?php

namespace DangKien\RolePer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

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
    	$user = $this->userModel::findOrFail($id)->with("roles")->first();
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
		$user = User::find($id);
        if (isset($request->roles))
        {
			$user->roles()->sync($request->roles);
        }
        else
        {
            $user->roles()->sync([]);
        }
		return redirect()->route('users.index');
    }
}
