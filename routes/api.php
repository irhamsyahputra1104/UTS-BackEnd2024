<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CovidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/patients', [CovidController::class, 'index'])->middleware('auth:sanctum');
Route::post('/patients', [CovidController::class, 'store'])->middleware('auth:sanctum');
Route::get('/patients/{id}', [CovidController::class, 'show'])->middleware('auth:sanctum');
Route::put('/patients/{patients}', [CovidController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/patients/{patients}', [CovidController::class, 'delete'])->middleware('auth:sanctum');

Route::get('/patients/search/{name}', [CovidController::class, 'search']);
Route::get('/patients/status/positive', [CovidController::class, 'getPositiveResources']);
Route::get('/patients/status/recovered', [CovidController::class, 'getRecoveredResources']);
Route::get('/patients/status/dead', [CovidController::class,'getDeadResources']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

