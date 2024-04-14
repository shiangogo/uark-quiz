<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\OrganizationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'home']);

Route::get('/users/new', [UsersController::class, 'new']);
Route::post('/users', [UsersController::class, 'create']);

Route::get('/sessions/new', [SessionsController::class, 'new'])->name('login');
Route::post('/sessions', [SessionsController::class, 'create']);
Route::delete('/sessions', [SessionsController::class, 'destroy']);

Route::get('/organizations/new', [OrganizationsController::class, 'new']);
Route::post('/organizations', [OrganizationsController::class, 'create']);

Route::fallback(function() {
    abort(404);
});
