<?php

use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::name('guest.')->group(function () {
    Route::get('/', [ GuestHomeController::class , 'home'])->name('home');
});

Route::name('admin.')->middleware('auth')->group(function () {
    Route::get('/home', [ AdminHomeController::class , 'home'])->name('home');
    Route::get('/projects/trashed', [ AdminProjectController::class, 'trashed'])->name('projects.trashed');
    Route::post('projects/trashed/{project}', [ AdminProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('projects/trashed/{project}', [ AdminProjectController::class, 'forceDelete'])->name('projects.forceDelete');
    Route::resource('/projects', AdminProjectController::class);
});