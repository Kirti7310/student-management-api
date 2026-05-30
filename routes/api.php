<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AttendanceController;

use App\Http\Controllers\SubjectController;


use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//students
Route::get('/students', [App\Http\Controllers\StudentController::class, 'index']);
Route::post('/students', [App\Http\Controllers\StudentController::class, 'store']);
Route::get('/students/{id}', [App\Http\Controllers\StudentController::class, 'show']);
Route::post('/students/{id}', [App\Http\Controllers\StudentController::class, 'update']);
Route::delete('/students/{id}', [App\Http\Controllers\StudentController::class, 'destroy']);


//atatndace
Route::get('/attendances', [AttendanceController::class, 'index']);
Route::post('/attendances', [AttendanceController::class, 'store']);

//subbjects
Route::get('/subjects', [App\Http\Controllers\SubjectController::class, 'index']);
Route::post('/subjects', [App\Http\Controllers\SubjectController::class, 'store']);
Route::get('/subjects/{id}', [App\Http\Controllers\SubjectController::class, 'show']);  

