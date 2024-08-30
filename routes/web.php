<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::get('/dashboard', function () {
    return view('panel.dashboard');
})->name('dashboard');


Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('users.index');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout');
});
Route::group(['middleware' => ['role:admin']], function () {

});

Route::controller(RoleController::class)->group(function () {
    Route::get('/roles', 'index')->name('role.index');
});


//Rote::controller(RoleController::class)->group(function () {})
