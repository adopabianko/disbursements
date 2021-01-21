<?php

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

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::group(['middleware' => ["permission:home*"]], function() {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });

    /**
     * Role
     */
    Route::group(['middleware' => ["permission:role*"]], function() {
        Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role');
        Route::get('/role/datatables', [App\Http\Controllers\RoleController::class, 'datatables'])->name('role.datatables');
        Route::get('/role/create', [App\Http\Controllers\RoleController::class, 'create'])->name('role.create');
        Route::post('/role/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
        Route::get('/role/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
        Route::put('/role/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
        Route::get('role/{role}/access-management', [App\Http\Controllers\RoleController::class, 'accessManagement'])->name('role.access-management');
        Route::post('role/access-management-store', [App\Http\Controllers\RoleController::class, 'accessManagementStore'])->name('role.access-management-store');
    });

    /**
     * Permission
     */
    Route::group(['middleware' => ["permission:permission*"]], function() {
        Route::get('/permission', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission');
        Route::get('/permission/datatables', [App\Http\Controllers\PermissionController::class, 'datatables'])->name('permission.datatables');
        Route::get('/permission/create', [App\Http\Controllers\PermissionController::class, 'create'])->name('permission.create');
        Route::post('/permission/store', [App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');
        Route::get('/permission/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
        Route::put('/permission/{permission}/update', [App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');
    });

    /**
     * User
     */
    Route::group(['middleware' => ["permission:user*"]], function() {
        Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
        Route::get('/user/datatables', [App\Http\Controllers\UserController::class, 'datatables'])->name('user.datatables');
        Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
        Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::get('/user/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
        Route::put('/user/{user}/profile-update', [App\Http\Controllers\UserController::class, 'profileUpdate'])->name('user.profile-update');
    });

    /**
     * Disbrusement
     */
    Route::get('/disbursement/checkstatus', [App\Http\Controllers\DisbursementController::class, 'checkstatus'])->name('disbursement.checkstatus');
    Route::get('/disbursement/create', [App\Http\Controllers\DisbursementController::class, 'create'])->name('disbursement.create');
    Route::post('/disbursement/store', [App\Http\Controllers\DisbursementController::class, 'store'])->name('disbursement.store');
    Route::post('/disbursement/updatestatus', [App\Http\Controllers\DisbursementController::class, 'updatestatus'])->name('disbursement.updatestatus');
    Route::get('/disbursement/list', [App\Http\Controllers\DisbursementController::class, 'list'])->name('disbursement.list');
    Route::get('/disbursement/datatables', [App\Http\Controllers\DisbursementController::class, 'datatables'])->name('disbursement.datatables');
});
