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
Route::post('/add-department', [App\Http\Controllers\HomeController::class, 'add_department'])->name('add_department');
Route::get('/edit-department/{id}', [App\Http\Controllers\HomeController::class, 'edit_department'])->name('edit_department');
Route::get('/delete-department{id}', [App\Http\Controllers\HomeController::class, 'delete_department'])->name('delete_department');

Route::get('/success-worker/{id}', [App\Http\Controllers\HomeController::class, 'success_user'])->name('success_user');

Route::get('/edit-worker/{id}', [App\Http\Controllers\HomeController::class, 'edit_user'])->name('edit_user');
Route::get('/delete-worker/{id}', [App\Http\Controllers\HomeController::class, 'delete_user'])->name('delete_user');
Route::get('/send-message/{id}', [App\Http\Controllers\HomeController::class, 'send_message'])->name('send_message');



