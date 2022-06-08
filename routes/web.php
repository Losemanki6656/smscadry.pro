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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/add-worker', [App\Http\Controllers\HomeController::class, 'add_worker'])->name('add_worker');
Route::get('/archive', [App\Http\Controllers\HomeController::class, 'archive'])->name('archive');
Route::get('/departments', [App\Http\Controllers\HomeController::class, 'departments'])->name('departments');




