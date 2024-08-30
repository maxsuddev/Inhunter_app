<?php

use App\Http\Controllers\Api\CandidatesController;
use Illuminate\Support\Facades\Route;


Route::post('/cadidate/create', [CandidatesController::class, 'store']);
