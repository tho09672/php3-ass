<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users=User::all();
        $roles=Role::all();
        return view('admin.users.index',compact('users','roles'));
    }
    public function addUser()
    {
        $roles=Role::all();
        return view('admin.users.add-user',['roles'=>$roles]);
    }
    public function saveUser(UserFormRequest $request)
    {
        $user=new User();
        $user->password=Hash::make($request->all()['password']);
        $user->fill($request->all());
        if($request->hasFile('avataUpload')){
            $path=$request->file('avataUpload')->store('public/uploads/users/');
            $user->avata = str_replace('public/', '', $path);
        }
        $user->save();
        # gán vai trò cho user
        if ($request->has('role') && $request->has('role') != null)
            $user->assignRole($request->role);//cấp vai trò cho user
        return redirect()->route('user.index')->with('msg','Thêm mới thành công');
    }
    public function editUser($id)
    {
        $user=User::find($id);
        $roles=Role::all();
        return view('admin.users.edit-user',compact('user','roles'));
    }
    public function updateUser(UserFormRequest $request,$id)
    {
        $user=User::find($id);
        $user->fill($request->all());
        if($request->hasFile('avataUpload')){
            $path=$request->file('avataUpload')->store('public/uploads/users/');
            $user->avata = str_replace('public/', '', $path);
            $path_old = storage_path().'/app/public/'.$request->avata;
            if(File::exists($path_old)){
                unlink($path_old);
            }
        }else{
            $user->avata =$request->avata;
        }
        $user->save();
        // cập nhật vai trò
        $user->syncRoles($request->role);
        return redirect()->route('user.index')->with('msg','Cập nhật thành công');

    }
    public function removeUser($id)
    {
        User::destroy($id);
        return redirect()->route('user.index');
    }
}
