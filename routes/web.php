<?php

use App\Http\Controllers\Admin\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::view('login','client.accounts.login')->name('login');
Route::post('login',[AccountController::class,'checkLogin'])->name('postLogin');
Route::get('logout',[AccountController::class,'logout'])->name('logout');
Route::view('change-pass','client.accounts.change-pass')->name('changePass');
Route::post('change-pass',[AccountController::class,'confirmChangePass'])->name('confirChangePass');
Route::view('edit-pass','client.accounts.edit-pass')->name('editPass');
Route::post('edit-pass',[AccountController::class,'updatePass'])->name('updatePass');
Route::get('register',[AccountController::class,'register'])->name('register');
Route::post('register',[AccountController::class,'saveAccount'])->name('account.save');
Route::get('edit-account/{id}',[AccountController::class,'editAccount'])->name('account.edit');
Route::post('edit-account/{id}',[AccountController::class,'updateAccount'])->name('account.update');

Route::view('demo','demo.demo-form');
// Route::post('demo',function(Request $request){
// $request->validate(['password'=>'min:5']);
// dd(1);
// });
// Route::view('new','demo.new');
// Route::view('demo2','demo.demo2');
