<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    //Sidebar
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/departments', [App\Http\Controllers\HomeController::class, 'departments'])->name('departments');
    Route::get('/archive-sms', [App\Http\Controllers\HomeController::class, 'archive_sms'])->name('archive_sms');
    Route::get('/actions', [App\Http\Controllers\HomeController::class, 'actions'])->name('actions');
    Route::get('/holidays', [App\Http\Controllers\HomeController::class, 'holidays'])->name('holidays');


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

    //holidasys
    Route::post('/add-holiday', [App\Http\Controllers\HomeController::class, 'add_holiday'])->name('add_holiday');
    Route::get('/edit-holiday/{id}', [App\Http\Controllers\HomeController::class, 'edit_holiday'])->name('edit_holiday');
    Route::get('/delete-holiday{id}', [App\Http\Controllers\HomeController::class, 'delete_holiday'])->name('delete_holiday');


    Route::get('/exportVacationToDoc/{id}', [App\Http\Controllers\OrganizationController::class, 'exportVacationToDoc'])->name('exportVacationToDoc');
    Route::post('/SendVacation', [App\Http\Controllers\HomeController::class, 'send_vac'])->name('send_vac');

    
    Route::get('/cadry/submitteds', [App\Http\Controllers\CadryController::class, 'submitteds'])->name('submitteds');
    Route::get('/cadry/accepteds', [App\Http\Controllers\CadryController::class, 'accepteds'])->name('accepteds');
});

