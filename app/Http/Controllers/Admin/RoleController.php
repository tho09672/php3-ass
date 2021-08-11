<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $pers = Permission::all();
        return view('admin.roles.index', ['roles' => $roles, 'pers' => $pers]);
    }
    public function addRole()
    {
        $pers = Permission::all();
        return view('admin.roles.add-role', ['pers' => $pers]);
    }
    public function saveRole(Request $request)
    {
        $request->validate(['name'=>'required|unique:roles']);
        $role = Role::create(['name' => $request->name]); //trả về đối tượng vừa được tạo
        if ($request->has('permission') && $request->has('permission') != null)
            foreach ($request->permission as $p) {
                $role->givePermissionTo($p);//cấp quyền cho vai trò
            }
        return redirect()->route('role.index')->with('msg','Thêm mới thành công');
    }
    public function editRole($id)
    {
        $role = Role::find($id);
        $pers = Permission::all();
        return view('admin.roles.edit-role', compact('role', 'pers'));
    }
    public function updateRole(Request $request, $id)
    {
        $request->validate(['name'=>[
            'required',
            Rule::unique('roles')->ignore($id)
        ]]);
        $role = Role::find($id);
        $role->name=$request->name;
        $role->save();
        $role->syncPermissions($request->permission);//đồng bộ hóa các quyền của role trong db với mảng hiện tại kể cả null-> xóa quyền khỏi role
        return redirect()->route('role.edit',['id'=>$id])->with('msg','Cập nhật thành công');
    }
    public function removeRole($id)
    {
        Role::destroy($id);
        return redirect()->route('role.index');
    }
}
