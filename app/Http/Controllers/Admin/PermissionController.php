<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionServiceProvider;

class PermissionController extends Controller
{
    public function index()
    {
        $pers = Permission::all();
        return view('admin.permissions.index', ['pers' => $pers]);
    }
    public function addPer()
    {
        return view('admin.permissions.add-per');
    }
    public function savePer(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions']);
        Permission::create(['name' => $request->name]);
        return redirect()->route('per.index')->with('msg','Thêm mới thành công');
    }
    public function editPer($id)
    {
        $per=Permission::find($id);
        return view('admin.permissions.edit-per',['per'=>$per]);

    }
    public function updatePer(Request $request,$id)
    {
        $request->validate(['name'=>[
            'required',
            Rule::unique('permissions')->ignore($id)
        ]]);
        $per=Permission::find($id);
        $per->name=$request->name;
        $per->save();
        return redirect()->route('per.index')->with('msg','Cập nhật thành công');

    }
    public function removePer($id)
    {
       Permission::destroy($id);
       return redirect()->route('per.index')->with('msg','Đã xóa thành công');
       
    }

}
