<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('admin.dasboard');

Route::prefix('room')->group(function () {
    Route::get('/', [RoomController::class, 'index'])
        ->middleware('permission:create|update|remove|review')->name('room.index');
    Route::middleware('permission:create')->group(function () {
        Route::get('add-room', [RoomController::class, 'addRoom'])->name('room.add');
        Route::post('add-room', [RoomController::class, 'saveRoom'])->name('room.save');
    });
    Route::middleware('permission:update|remove')->group(function () {
        Route::get('edit-room/{id}', [RoomController::class, 'editRoom'])->name('room.edit');
        Route::post('edit-room/{id}', [RoomController::class, 'updateRoom'])->name('room.update');
        Route::get('delete-room/{id}', [RoomController::class, 'removeRoom'])->name('room.remove');
    });
});
Route::prefix('service')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])
        ->middleware('permission:create|update|remove|review')->name('service.index');
    Route::middleware('permission:create')->group(function () {
        Route::get('add-service', [ServiceController::class, 'addService'])->name('service.add');
        Route::post('add-service', [ServiceController::class, 'saveService'])->name('service.save');
    });
    Route::middleware('permission:update|remove')->group(function () {
        Route::get('edit-service/{id}', [ServiceController::class, 'editService'])->name('service.edit');
        Route::post('edit-service/{id}', [ServiceController::class, 'updateService'])->name('service.update');
        Route::get('delete-service/{id}', [ServiceController::class, 'removeService'])->name('service.remove');
    });
});
Route::middleware('permission:manager user')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('add-user', [UserController::class, 'addUser'])->name('user.add');
        Route::post('add-user', [UserController::class, 'saveUser']);
        Route::get('edit-user/{id}', [UserController::class, 'editUser'])->name('user.edit');
        Route::post('edit-user/{id}', [UserController::class, 'updateUser'])->name('user.update');
        Route::get('remove-user/{id}', [UserController::class, 'removeUser'])->name('user.remove');
    });
    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('add-role', [RoleController::class, 'addRole'])->name('role.add');
        Route::post('add-role', [RoleController::class, 'saveRole'])->name('role.save');
        Route::get('edit-role/{id}', [RoleController::class, 'editRole'])->name('role.edit');
        Route::post('edit-role/{id}', [RoleController::class, 'updateRole'])->name('role.update');
        Route::get('remove-role/{id}', [RoleController::class, 'removeRole'])->name('role.remove');
    });
    Route::prefix('per')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('per.index');
        Route::get('add-per', [PermissionController::class, 'addPer'])->name('per.add');
        Route::post('add-per', [PermissionController::class, 'savePer'])->name('per.save');
        Route::get('edit-per/{id}', [PermissionController::class, 'editPer'])->name('per.edit');
        Route::post('edit-per/{id}', [PermissionController::class, 'updatePer'])->name('per.update');
        Route::get('remove-per/{id}', [PermissionController::class, 'removePer'])->name('per.remove');
    });
});


// Route::get('demo',function(){
//    $service=Service::orderBy('id')->get();
//    return view('demo.demo-query',['service'=>$service]);
// });
