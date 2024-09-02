<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
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


Route::controller(RoleController::class)->group(function () {
    Route::get('/roles', 'index')->name('role.index');
});

Route::controller(PermissionController::class)->group(function () {
    Route::get('/permission', 'index')->name('permission.index');
});

Route::controller(CandidateController::class)->group(function () {
    Route::get('/candidate', 'index')->name('candidate.index');
    Route::get('candidate/{candidate}', 'show')->name('candidate.show');
});


Route::controller(CompanyController::class)->group(function () {
   Route::get('/company', 'index')->name('company.index');
   Route::get('company/create', 'create')->name('company.create');
   Route::post('company', 'store')->name('company.store');
});

Route::controller(CategoryController::class)->group(function () {
   Route::get('/category', 'index')->name('category.index');
   Route::get('category/create', 'create')->name('category.create');
   Route::post('category', 'store')->name('category.store');
});

Route::controller(VacancyController::class)->group(function () {
   Route::get('/vacancy', 'index')->name('vacancy.index');
});


