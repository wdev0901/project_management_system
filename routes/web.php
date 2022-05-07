<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

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

Route::get('/', function () {
    return view('auth.login');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function(){
    Route::resource('dashboard', DashboardController::class);
    Route::post('filter', [DashboardController::class, 'taskFilter'])->name('filter');
    Route::resource('projects', ProjectController::class);
    Route::resource('users', UserController::class);
    Route::resource('tasks', TaskController::class);
});
