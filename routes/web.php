<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LampiranController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProviderLamaranController;

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

Route::get('/', [JobsController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::resource('/jobs', JobsController::class);
Route::get('/jobs/create', [JobsController::class, 'create']);
Route::post('/jobs/store', [JobsController::class, 'store']);

Route::get('/jobs/checkSlug', [JobsController::class, 'checkSlug']);
Route::get('/lamaran/{job}', [JobsController::class, 'lamar']);


Route::resource('/profile', UserController::class);
Route::resource('/contact', SosmedController::class);
Route::resource('/lampiran', LampiranController::class);

Route::post('/lamar/store', [LamaranController::class, 'store']);
Route::resource('/lamar', LamaranController::class);
Route::resource('/lamarans', ProviderLamaranController::class);
