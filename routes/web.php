<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::group(['prefix' => 'password'], function () {
    Route::get('/forget', [AuthController::class, 'forgetPassword'])->name('forget_password');
    Route::post('/reset', [AuthController::class, 'resetPassword'])->name('check_password_reset');
    Route::get('/reset/{token}', [AuthController::class, 'getChangePassword'])->name('reset_password_link');
    Route::post('/reset/new/{token}', [AuthController::class, 'postChangePassword'])->name('change_password');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'getUsers'])->name('admin.users');
    Route::get('/users/add', [AdminController::class, 'addUser'])->name('admin.users.add');
    Route::post('/users/save', [AdminController::class, 'saveUser'])->name('admin.users.add.save');
    Route::get('/users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/users/update', [AdminController::class, 'updateUser'])->name('admin.users.update.save');
    Route::get('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/users/change/{id}', [AdminController::class, 'changePassword'])->name('admin.users.change');
    Route::post('/users/change-password', [AdminController::class, 'updateChangePassword'])->name('admin.users.password.change');
    Route::get('/events', [AdminController::class, 'getEvents'])->name('admin.events');
    Route::get('/events/add', [AdminController::class, 'addEvent'])->name('admin.events.add');
    Route::post('/events/save', [AdminController::class, 'saveEvent'])->name('admin.events.add.save');
    Route::get('/events/edit/{id}', [AdminController::class, 'editEvent'])->name('admin.events.edit');
    Route::post('/events/update', [AdminController::class, 'updateEvent'])->name('admin.events.update.save');
    Route::get('/events/delete/{id}', [AdminController::class, 'deleteEvent'])->name('admin.events.delete');
    Route::get('/events/list/{id}', [AdminController::class, 'listEventDays'])->name('admin.events.list');
    Route::get('/events/day/{id}', [AdminController::class, 'editEventDay'])->name('admin.events.edit.day');
    Route::post('/events/day/update', [AdminController::class, 'updateEventDay'])->name('admin.events.day.update.save');
    Route::get('/yatriks', [AdminController::class, 'getYatriks'])->name('admin.yatriks');
    Route::get('/yatriks/add', [AdminController::class, 'addYatrik'])->name('admin.yatriks.add');
    Route::post('/yatriks/save', [AdminController::class, 'saveYatrik'])->name('admin.yatriks.add.save');
    Route::get('/yatriks/edit/{id}', [AdminController::class, 'editYatrik'])->name('admin.yatriks.edit');
    Route::post('/yatriks/update', [AdminController::class, 'updateYatrik'])->name('admin.yatriks.update.save');
    Route::get('/yatriks/delete/{id}', [AdminController::class, 'deleteYatrik'])->name('admin.yatriks.delete');
    Route::get('/yatriks/view/{id}', [AdminController::class, 'viewYatrik'])->name('admin.yatriks.view');
    Route::get('/yatriks/import', [AdminController::class, 'importYatriks'])->name('admin.yatriks.import');
    Route::post('/yatriks/import/save', [AdminController::class, 'saveImportYatriks'])->name('admin.yatriks.import.save');
    Route::get('/yatriks/assign', [AdminController::class, 'assignYatriks'])->name('admin.yatriks.assign');
    Route::post('/fetch-yatriks', [AdminController::class, 'fetchYatriksByEvent'])->name('admin.yatriks.fetch');
    Route::post('/yatriks/assign/save', [AdminController::class, 'saveAssignYatriks'])->name('admin.yatriks.assign.save');
});