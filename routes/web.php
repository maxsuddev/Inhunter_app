<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::get('error', function () {
    return view('error_forbidden');
})->name('error.forbidden');

//Auth
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout');
});
Route::group(['middleware' => ['auth']], function () {

Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/dashboard', function () {
        return view('panel.dashboard');
    })->name('dashboard');


//User
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::get('/user/{user}', 'show')->name('user.show')->middleware('is_user');
    });


//Role
    Route::controller(RoleController::class)->group(function () {
        Route::get('/role', 'index')->name('role.index');
    });
//Permission
    Route::controller(PermissionController::class)->group(function () {
        Route::get('/permission', 'index')->name('permission.index');
    });
//Candidate
    Route::controller(CandidateController::class)->group(function () {
        Route::get('/candidate', 'index')->name('candidate.index');
        Route::get('candidate/create', 'create')->name('candidate.create');
        Route::get('candidate/{candidate}', 'show')->name('candidate.show');
        Route::post('candidate', 'store')->name('candidate.store');
        Route::put('candidate/{candidate}', 'update')->name('candidate.update');
    });

//Company
    Route::controller(CompanyController::class)->group(function () {
        Route::get('/company', 'index')->name('company.index');
        Route::get('company/create', 'create')->name('company.create');
        Route::post('company', 'store')->name('company.store');
        Route::get('company/{company}', 'show')->name('company.show');
        Route::put('company/{id}', 'update')->name('company.edit');
        Route::delete('company/{company}', 'delete')->name('company.delete');
    });
//Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category', 'store')->name('category.store');
        Route::get('category/{category}', 'show')->name('category.show');
        Route::put('category{id}', 'update')->name('category.edit');
        Route::delete('category/{category}', 'delete')->name('category.delete');
    });
//Vacancy
    Route::controller(VacancyController::class)->group(function () {
        Route::get('/vacancy', 'index')->name('vacancy.index');

        Route::get('vacancy/create', 'create')->name('vacancy.create');
        Route::post('vacancy', 'store')->name('vacancy.store');
        Route::get('vacancy/{vacancy}', 'show')->name('vacancy.show');

    });
    Route::get('/vacancy/change-state/{vacancy}', [VacancyController::class, 'changeState'])->name('vacancy.changeState');


});
});


