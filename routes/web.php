<?php

use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\TechnologyController as AdminTechnologyController;
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
    Route::get('/', [ GuestHomeController::class , 'home' ])->name('home');
});

Route::name('admin.')->middleware('auth')->group(function () {
    Route::get('/home', [ AdminHomeController::class , 'home'])->name('home');
    Route::get('/projects/trashed', [ AdminProjectController::class, 'trashed' ])->name('projects.trashed');
    Route::post('/projects/trashed/{project}', [ AdminProjectController::class, 'restore' ])->name('projects.restore');
    Route::delete('/projects/trashed/{project}', [ AdminProjectController::class, 'forceDelete' ])->name('projects.forceDelete');
    Route::resource('/projects', AdminProjectController::class);
});

Route::name('admin.')->middleware('auth')->group(function () {
    Route::get('/types/trashed', [ AdminTypeController::class, 'trashed' ])->name('types.trashed');
    Route::post('/types/trashed/{type}', [ AdminTypeController::class, 'restore' ])->name('types.restore');
    Route::delete('/types/trashed/{type}', [ AdminTypeController::class, 'forceDelete' ])->name('types.forceDelete');
    Route::resource('/types', AdminTypeController::class);
});

Route::name('admin.')->middleware('auth')->group(function () {
    Route::get('/technologies/trashed', [ AdminTechnologyController::class, 'trashed' ])->name('technologies.trashed');
    Route::post('/technologies/trashed/{type}', [ AdminTechnologyController::class, 'restore' ])->name('technologies.restore');
    Route::delete('/technologies/trashed/{type}', [ AdminTechnologyController::class, 'forceDelete' ])->name('technologies.forceDelete');
    Route::resource('/technologies', AdminTechnologyController::class);
});