<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




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

Route::post('/students', [App\Http\Controllers\StudentController::class, 'store']);
Route::match(['post', 'put'], '/students/{student}', [App\Http\Controllers\StudentController::class, 'update']);
Route::delete('/students/{student}', [App\Http\Controllers\StudentController::class, 'destroy']);






Route::get('/students', [App\Http\Controllers\StudentController::class, 'index']);
Route::get('/students/{student}', [App\Http\Controllers\StudentController::class, 'show']);



//subbjects
Route::get('/subjects', [App\Http\Controllers\SubjectController::class, 'index']);
Route::post('/subjects', [App\Http\Controllers\SubjectController::class, 'store']);
Route::get('/subjects/{subject}', [App\Http\Controllers\SubjectController::class, 'show']);
Route::match(['post', 'put'], '/subjects/{subject}', [App\Http\Controllers\SubjectController::class, 'update']);
Route::delete('/subjects/{subject}', [App\Http\Controllers\SubjectController::class, 'destroy']);
