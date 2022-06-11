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

//Sidebar
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/departments', [App\Http\Controllers\HomeController::class, 'departments'])->name('departments');
Route::get('/archive-sms', [App\Http\Controllers\HomeController::class, 'archive_sms'])->name('archive_sms');
Route::get('/actions', [App\Http\Controllers\HomeController::class, 'actions'])->name('actions');


//Department Menu
Route::post('/add-department', [App\Http\Controllers\HomeController::class, 'add_department'])->name('add_department');
Route::get('/edit-department/{id}', [App\Http\Controllers\HomeController::class, 'edit_department'])->name('edit_department');
Route::get('/delete-department{id}', [App\Http\Controllers\HomeController::class, 'delete_department'])->name('delete_department');


//Workers Menu
Route::post('/add-worker', [App\Http\Controllers\HomeController::class, 'add_worker'])->name('add_worker');
Route::post('/update-med-worker/{id}', [App\Http\Controllers\HomeController::class, 'update_med_cadry'])->name('update_med_cadry');
Route::post('/edit-worker/{id}', [App\Http\Controllers\HomeController::class, 'edit_worker'])->name('edit_worker');
Route::get('/delete-worker/{id}', [App\Http\Controllers\HomeController::class, 'delete_worker'])->name('delete_worker');
Route::post('/send-message/{id}', [App\Http\Controllers\HomeController::class, 'send_message'])->name('send_message');

Route::get('/cadry/vacation/{id}', [App\Http\Controllers\HomeController::class, 'vacation'])->name('vacation');



