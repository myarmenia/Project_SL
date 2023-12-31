<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Log\LogService;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);

        return view('users.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = [
            'username' => 'required|unique:users,username',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $input = $request->except('roles', 'confirm-password');

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        LogService::store($data, $user->id, 'users', 'add');

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($local, $id)
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($local, $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->first();

        $log = LogService::store(null, $user->id, 'users', 'view');

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $local, $id)
    {
        $input = $request->all();
        $user = User::find($id);

        $validate = [
            'roles' => 'required'
        ];

        if($request->username != $user->username) {
            $validate['username'] = 'required|unique:users,username';
        }

        if($request->password != null) {
            $validate['password'] = 'required|same:confirm-password';
        }

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }


        $user->update([
            'username' => $input['username'],
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],

        ]);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        $log = LogService::store($input, $user->id, 'users', 'edit');

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        User::find($id)->delete();

        LogService::store(null, $id, 'users', 'delete');

        return response(['result', 1]);
        // return redirect()->route('users.index')
        //     ->with('success', 'User deleted successfully');
    }

    public function change_status($lang, $id, $status) {

        $user = User::find($id);

        if($user) {
            $user->status = $status;
            $user->save();
        }

        $data = ['status'=> $status];

        LogService::store($data, $user->id, 'users', "edit");

        return redirect()->back();
    }
}
