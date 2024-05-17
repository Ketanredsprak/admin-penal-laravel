<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
      return view('Front.under-development');
});


Route::get('admin/login', [AdminController::class, 'adminLogin'])->name('admin/login');
Route::post('admin-login', [AdminController::class, 'storeLogin'])->name('admin-login');
Route::post('/language-change', [AdminController::class, 'languageChange'])->name('language.change');

Route::prefix('admin')->middleware('auth')->group(function () {
      Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
      Route::patch('/profile', [AdminController::class, 'update'])->name('profile.update');
      Route::post('/getChangePassword', [AdminController::class, 'storeChangePassword'])->name('store.change.password');
      Route::get('/setting', [AdminController::class, 'setting'])->name('setting');

        // Our resource routes
        Route::resource('user', UserController::class);
        Route::get('user-status/{id}', [UserController::class, 'userStatus'])->name('user.status');

        // Our resource routes
        Route::resource('country', CountryController::class);
        Route::get('country-status/{id}', [CountryController::class, 'countryStatus'])->name('country.status');

        Route::resource('state', StateController::class);
        Route::get('state-status/{id}', [StateController::class, 'stateStatus'])->name('state.status');
        Route::post('state-list', [StateController::class, 'listState'])->name('state.list');

        Route::resource('city', CityController::class);
        Route::get('city-status/{id}', [CityController::class, 'cityStatus'])->name('city.status');

        Route::resource('module', ModuleController::class);
        Route::get('module-status/{id}', [ModuleController::class, 'moduleStatus'])->name('module.status');

        Route::resource('permission', PermissionController::class);
        Route::get('permission-status/{id}', [PermissionController::class, 'permissionStatus'])->name('permission.status');

        Route::resource('role', RoleController::class);
        Route::get('role-status/{id}', [RoleController::class, 'roleStatus'])->name('role.status');

});




require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
