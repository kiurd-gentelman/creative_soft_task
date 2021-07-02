<?php

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

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;

Route::view('/', 'layouts.app');

Auth::routes();

Route::get('/employee/delete/{id}', [EmployeeController::class, 'delete']);
Route::post('/employee/store', [EmployeeController::class, 'store']);
Route::post('/employee/update/{id}', [EmployeeController::class, 'update']);
Route::get('/employees', [EmployeeController::class, 'employees']);


Route::get('/task/delete/{id}', [TaskController::class, 'delete']);
Route::post('/task/store', [TaskController::class, 'store']);
Route::post('/task/update/{id}', [TaskController::class, 'update']);
Route::get('/get-tasks', [TaskController::class, 'index']);

Route::get('/{any?}', function () {
    return view('layouts.app');
})->where('any', '[\/\w\.-]*');
