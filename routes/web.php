<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [HomeController::class, 'login']);

Route::post('/login', [HomeController::class, 'doLogin']);

Route::get('/package/create', [PackageController::class, 'showCreate']);

Route::post('/package/create', [PackageController::class, 'doCreate']);

Route::get('/package/view/{id}', [PackageController::class, 'view']);
