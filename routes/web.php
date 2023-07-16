<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepositoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('repositories',  [RepositoryController::class, 'fetch'])->name('repositories');
Route::post('/repositories/refresh', [RepositoryController::class, 'refresh'])->name('repositories.refresh');
Route::get('/repositories/{id}', [RepositoryController::class, 'show'])->name('repositories.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

