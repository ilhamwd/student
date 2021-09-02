<?php

use App\Http\Controllers\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/get_all_students', [Student::class, 'getAllStudents']);
Route::post('/manipulate_students_data', [Student::class, 'manipulation']);
Route::post('/delete_student', [Student::class, 'deleteStudent']);