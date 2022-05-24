<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware('auth');
    //      $this->middleware('permission:read|write|delete', ['only' => ['index','store', 'edit', 'update', 'destroy']]);
    //      $this->middleware('permission:write', ['only' => ['index','store']]);
    //      $this->middleware('permission:delete', ['only' => ['index','destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::pluck('name','name')->all();
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users',compact('data', 'roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'employeeID'        => 'required',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required|email|unique:users,email',
            'username'          => 'required',
            'password'          => 'required|same:confirm-password',
            'roles'             => 'required'
        ]);

        $input = $request->all();
        $input['name'] = $input['first_name']." ".$input['last_name'];
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->roles);

        return redirect()->route('index.users')
                        ->with('success','User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'employeeID'        => 'required',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required|email|unique:users,email,'.$id,
            'username'          => 'required',
            'password'          => 'same:confirm-password',
            'roles'             => 'required'
        ]);

        $input = $request->all();

        $input['name'] = $input['first_name']." ".$input['last_name'];

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->roles);

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('index.users')
                        ->with('success','User deleted successfully');
    }
}
