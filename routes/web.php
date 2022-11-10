<?php

use App\Http\Controllers\MainController;
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
// Route::get('verifyStudent',[MainController::class, 'stulogin'] );

Route::get('/',[MainController::class, 'home'] );
Route::get('stulogin',[MainController::class, 'stuLogin'] );
Route::get('tealogin',[MainController::class, 'teaLogin'] );
Route::get('sturegister',[MainController::class, 'stuRegister']);
Route::get('tearegister',[MainController::class, 'teaRegister']);
Route::get('logout',[MainController::class, 'logout'] );

Route::post('adduser',[MainController::class, 'addUser']);
Route::post('addteacher',[MainController::class, 'addTeacher']);
Route::post('validateStudent',[MainController::class, 'validateStudent']);
Route::post('validateTeacher',[MainController::class, 'validateTeacher']);

Route::get('teachers',[MainController::class, 'showTeachers'] );
Route::get('showTea',[MainController::class, 'teachers'] );


Route::get('students',[MainController::class, 'show']);
Route::get('students/create',[MainController::class, 'create']);
Route::post('students/store',[MainController::class, 'store']);
Route::get('students/{id}/edit',[MainController::class, 'edit']);
Route::put('students/{id}/update',[MainController::class, 'update']);
Route::post('students/delete',[MainController::class, 'delete']);

Route::get('chat/teacher/{id}',[MainController::class, 'chatTeacher']);
Route::get('chat/student/{id}',[MainController::class, 'chatStudent']);
Route::post('chat/teacher/sendMessage',[MainController::class,'sendMessage']);
Route::post('chat/student/sendMessage',[MainController::class,'sendMessage']);





