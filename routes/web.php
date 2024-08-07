<?php

use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SettingWebController;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes([
'register' => false,
'reset' => false,
'verify' => false,
]);

//===========================================================================================Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/edit-profile', [App\Http\Controllers\HomeController::class, 'editprofile']);
Route::post('/home/edit-profile', [App\Http\Controllers\HomeController::class, 'aksieditprofile']);

//===========================================================================================Users
Route::get('/list-data-users',[UserController::class,'listdata']);
Route::resource('users', UserController::class);

//===========================================================================================Roles
Route::get('/list-data-roles',[RolesController::class,'listdata']);
Route::resource('roles', RolesController::class);

//===========================================================================================Permission
Route::get('/list-data-permission',[PermissionController::class,'listdata']);

Route::resource('permission', PermissionController::class);

//===========================================================================================Setting-Web
Route::get('/setting-web',[SettingWebController::class,'index']);
Route::post('/setting-web',[SettingWebController::class,'store']);

//==================================================================Employee
Route::resource('employee',EmployeeController::class);
Route::post('/employee/store',[EmployeeController::class,'store']);
Route::get('/list-data-employee', [EmployeeController::class, 'listdata']);
Route::get('/get-cities/{provinceId}', [EmployeeController::class, 'getCities']);



