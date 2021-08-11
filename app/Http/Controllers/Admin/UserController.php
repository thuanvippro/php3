<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\ModelHasRole;
use App\Models\Permission;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        // echo '<pre>';var_dump($users);
        return view('admin.users.index', compact('users'));
    }
    public function addFormUser(){
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.add-form', compact('roles', 'permissions'));
    }
    public function editFormUser($id){
        $user = User::find($id);
        if(!$user){
            return redirect()->back();
        }
        $roles = Role::all();
        
        return view('admin.users.edit-form', compact('roles', 'user'));
    }
    public function saveEditUser($id, Request $request){
        // dd($request->model_has_roles);
        $m = User::find($id);
        foreach($m->roles as $mr){
            $m->removeRole($mr->name);
        }
        $m->removeRole($request->model_has_roles);
        $m->fill($request->all());
        $m->password = $m->password;
        $m->save();
        if($request->has('model_has_roles')){
            User::find($m->id)->assignRole($request->model_has_roles);
        }
        return back()->with('msg', 'Cập nhập thành công');
    }
    public function saveUser(UserRequest $request){
        // dd($request->model_has_permissions);
        $model = new User();
        $model->fill($request->all());
        $model->password = Hash::make($request->password);
        $model->save();
        // if($request->has('model_has_permissions')){
        //     $model->id->givePermissionsTo($request->model_has_roles);
        // }
        if($request->has('model_has_roles')){
            // $MHR = new ModelHasRole();
            // $MHR->role_id = $request->model_has_roles;
            // $MHR->model_type = "App\Models\User";
            // $MHR->model_id = $model->id;
            // $MHR->save();
            
            User::find($model->id)->assignRole($request->model_has_roles);
        }
        return back()->with('msg', 'Đăng kí thành công');
    }
    public function deleteUser($id){
        // dd($id);
        User::destroy($id);
        return redirect()->back();
    }
    public function registration(){
        return view('auth.registration');
    }
    public function saveRegistration(UserRequest $request){
        $model = new User();
        $model->fill($request->all());
        $model->password = Hash::make($request->password);
        $model->assignRole("nguoi dung");
        $model->save();
        return back()->with('msg', 'Đăng kí thành công');
    }
}
