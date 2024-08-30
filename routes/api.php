<?php

use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/cadidate/create', [CandidatesController::class, 'store']);
