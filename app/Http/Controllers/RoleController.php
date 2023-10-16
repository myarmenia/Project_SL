<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Log\LogService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        
        //  $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:role-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);

        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('id','DESC')->get();
        // $permission = Permission::get();
        $permissions = Permission::get()->groupBy('title');

        return view('roles.create',compact('permissions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');   //for log

        $this->validate($request, [
            'name' => 'required|unique:roles,name|regex:/^[a-zA-Z0-9]+$/u',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        $log = LogService::store($data, $role->id, 'role', 'add');

        return $log ? redirect()->route('roles.index')
            ->with('success','Role created successfully') : null;

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        // $role = Role::find($id);
        // $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        //     ->where("role_has_permissions.role_id",$id)
        //     ->get();

        // return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {

        $roles = Role::orderBy('id','DESC')->get();
        $role = Role::find($id);
        $permissions = Permission::get()->groupBy('title');

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $log = LogService::store(null, $role->id, 'role', 'view');


        return view('roles.edit',compact('role','roles','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale, $id)
    {
        $data = $request->except(['_method','_token']);

        $this->validate($request, [
            // 'name' => 'required|unique:roles,name|regex:/^[a-zA-Z0-9]+$/u',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        // $role->name = $request->input('name');
        // $role->save();

        $role->syncPermissions($request->input('permission'));

        $log = LogService::store($data, $role->id, 'role', 'edit');

        return $log ? redirect()->route('roles.index') : null;

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        // DB::table("roles")->where('id',$id)->delete();
        // return redirect()->route('roles.index')
        //                 ->with('success','Role deleted successfully');
    }
}
