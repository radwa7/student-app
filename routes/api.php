<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('students', [StudentController::class, 'showAll']);
Route::get('students/{id}', [StudentController::class, 'showStudent']);
Route::post('students', [StudentController::class,'save' ]);
Route::put('students/{id}', [StudentController::class, 'update']);
Route::delete('students/{id}', [StudentController::class,'delete']);
