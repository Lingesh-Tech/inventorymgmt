<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])->name('home');
    Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role');
    Route::get('/permission', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission');
    Route::get('/rolespermission', [App\Http\Controllers\RolesPermissionController::class, 'index'])->name('rolespermission');

    /* inventory routes */
    Route::post('/create-product',[App\Http\Controllers\ProductController::class, 'store']);
    Route::post('/edit-product/{id}',[App\Http\Controllers\ProductController::class, 'edit']);
    Route::post('/update-product/{id}',[App\Http\Controllers\ProductController::class, 'update']);
    Route::post('/delete-product/{id}',[App\Http\Controllers\ProductController::class, 'destroy']);

    /* roles routes */
    Route::post('/create-role',[App\Http\Controllers\RoleController::class, 'store']);
    Route::post('/edit-role/{id}',[App\Http\Controllers\RoleController::class, 'edit']);
    Route::post('/update-role/{id}',[App\Http\Controllers\RoleController::class, 'update']);
    Route::post('/delete-role/{id}',[App\Http\Controllers\RoleController::class, 'destroy']);

    /* permission routes */
    Route::post('/create-permission',[App\Http\Controllers\PermissionController::class, 'store']);
    Route::post('/edit-permission/{id}',[App\Http\Controllers\PermissionController::class, 'edit']);
    Route::post('/update-permission/{id}',[App\Http\Controllers\PermissionController::class, 'update']);
    Route::post('/delete-permission/{id}',[App\Http\Controllers\PermissionController::class, 'destroy']);

    /* roles permission routes */
    Route::post('/create-role-permission',[App\Http\Controllers\RolesPermissionController::class, 'store']);
    Route::post('/edit-role-permission/{id}',[App\Http\Controllers\RolesPermissionController::class, 'edit']);
    Route::post('/update-role-permission/{id}',[App\Http\Controllers\RolesPermissionController::class, 'update']);
    Route::post('/delete-role-permission/{id}',[App\Http\Controllers\RolesPermissionController::class, 'destroy']);
});