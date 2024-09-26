<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangeState;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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
//Route::group(['middleware' => ['auth']], function () {
//Route::group(['middleware' => ['role:employee|manager']], function () {

        Route::get('/dashboard', function () {
            return view('panel.dashboard');
        })->name('dashboard');


       Route::controller(UserController::class)->group(function () {
            Route::get('/user', 'index')->name('user.index')->middleware('permission:index-users'); // 2
            Route::get('/user/{user}', 'show')->name('user.show')->middleware('is_user', 'permission:show-users'); //2
            Route::get('/user/create', 'create')->name('user.create')->middleware('permission:create-user'); //M

            Route::get('/user/{user}/vacancy', 'user_vacancies')->name('user.vacancy')->middleware('is_user', 'permission:users-vacancies'); //E
            Route::get('/user/{user}/candidate', 'user_candidate')->name('user.candidate')->middleware('is_user', 'permission:users-candidate'); //E
            Route::post('/user/{user}/candidate', 'updateStatusCandidate')->name('candidate.updateStatus')->middleware('candidate.owner', 'permission:candidates-owner'); //E

        });


        //Role
        Route::controller(RoleController::class)->group(function () {
            Route::get('/role', 'index')->name('role.index')->middleware('permission:index-roles'); //M
        });
        //Permission
        Route::controller(PermissionController::class)->group(function () {
            Route::get('/permission', 'index')->name('permission.index'); //M
        });
        //Candidate
        Route::controller(CandidateController::class)->group(function () {
            Route::get('/candidate', 'index')->name('candidate.index')->middleware('permission:index-candidates'); //2
            Route::get('candidate/create', 'create')->name('candidate.create')->middleware('permission:create-candidates');//E
            Route::get('candidate/{candidate}', 'show')->name('candidate.show')->middleware('permission:show-candidates');//E
            Route::post('candidate', 'store')->name('candidate.store')->middleware('permission:create-candidates');//E
            Route::put('candidate/{candidate}', 'update')->name('candidate.update')->middleware('permission:update-candidates');//E
        });


        //Company
        Route::controller(CompanyController::class)->group(function () {
            Route::get('/company', 'index')->name('company.index')->middleware('permission:index-companies');//2
            Route::get('company/create', 'create')->name('company.create')->middleware('permission:create-companies'); //M
            Route::post('company', 'store')->name('company.store')->middleware('permission:create-companies'); //M
            Route::get('company/{company}', 'show')->name('company.show')->middleware('permission:show-companies'); //M
            Route::put('company/{id}', 'update')->name('company.edit')->middleware('permission:update-companies'); //M
            Route::delete('company/{company}', 'delete')->name('company.delete')->middleware('permission:delete-companies'); //M
        });
        //Category
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category', 'index')->name('category.index')->middleware('permission:index-categories');//2
            Route::get('category/create', 'create')->name('category.create')->middleware('permission:create-categories'); //M
            Route::post('category', 'store')->name('category.store')->middleware('permission:create-categories'); //M
            Route::get('category/{category}', 'show')->name('category.show')->middleware('permission:show-categories'); //M
            Route::put('category{id}', 'update')->name('category.edit')->middleware('permission:update-categories'); //M
            Route::delete('category/{category}', 'delete')->name('category.delete')->middleware('permission:delete-categories'); //M
        });
        //Vacancy
        Route::controller(VacancyController::class)->group(function () {
            Route::get('/vacancy', 'index')->name('vacancy.index')->middleware('permission:index-vacancies');//2
            Route::get('vacancy/create', 'create')->name('vacancy.create')->middleware('permission:create-vacancies'); //M
            Route::post('vacancy', 'store')->name('vacancy.store')->middleware('permission:create-vacancies'); //M
            Route::get('vacancy/{vacancy}', 'show')->name('vacancy.show')->middleware('permission:show-vacancies'); //2
        });

    Route::controller(ChangeState::class)->group(function () {
        Route::get('/vacancy/change-state/{vacancy}', 'changeStateVacancy')->name('vacancy.changeState')->middleware('permission:change-state'); //E
        Route::get('/candidate/change-state/{candidate}', 'changeStateCandidate')->name('candidate.changeState')->middleware('permission:change-state'); //E
        Route::post('/user/{user}/vacancy', 'updateStateVacancy')->name('vacancy.updateStatus')->middleware('permission:update-vacancies'); //E
        Route::put('/user/{user}/vacancy', 'assignCandidate')->name('vacancy.assignCandidate')->middleware('permission:update-vacancies'); //E



        });
   // });

//});
