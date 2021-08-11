<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function checkLogin(Request $request)
    {
        if (
            Auth::attempt(['email' => $request->email, 'password' => $request->password])
            || Auth::attempt(['phone' => $request->email, 'password' => $request->password])
        ) {

            return redirect()->route('home');
        }

        return redirect()->back()->with('data', ['msg' => 'Đăng nhập thất bại', 'form_data' => $request->email]);
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('home');
        }
    }
    public function confirmChangePass(Request $request)
    {
        if (
            Auth::attempt(['email' => $request->email, 'password' => $request->password])
            || Auth::attempt(['phone' => $request->email, 'password' => $request->password])
        ) {

            return redirect()->route('editPass');
        }

        return redirect()->back()->with('data', ['msg' => 'Sai thông tin xác thực', 'form_data' => $request->email]);
    }
    public function updatePass(Request $request)
    {
        $request->validate(['password'=>'required|min:5']);
        if ($request->password != $request->confirmPassword) {
            return redirect()->back()->with('msg','Xác nhận mk không đúng');
        }
        $user_id=Auth::id();
        $user=User::find($user_id);
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->route('home')->with('msg','Cập nhật mk thành công');
    }
    public function register()
    {
       return view('client.accounts.register');
    }
    public function saveAccount(UserFormRequest $request)
    {
        $user=new User();
        $user->password=Hash::make($request->password);
        $user->fill($request->all());
        if($request->hasFile('avataUpload')){
            $path=$request->file('avataUpload')->store('public/uploads/users/');
            $user->avata = str_replace('public/', '', $path);
        }
        $user->save();
        return redirect()->route('login');
    }
    public function editAccount()
    {
       $user=Auth::user();
       return view('client.accounts.edit-account',['user'=>$user]);
    }
    public function updateAccount(UserFormRequest $request,$id)
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
        return redirect()->route('account.edit',['id'=>$id])->with('msg','Cập nhật thành công');

    }
}
