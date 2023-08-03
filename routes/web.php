<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommitConrtoller;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RoleController;

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


Route::get('logout', [LoginController::class,'logout']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Auth::routes();
Route::get('/main', [MainController::class, 'index'])->name('main');

Route::middleware(['auth'])->group(function () {
    Route::resource('ticket', TicketController::class);
    Route::resource('category', CategoryController::class);
    //Route::get('/commit/create/{id}', [CommitController::class, 'create'])->name('commit.create');

    Route::resource('commit', CommitConrtoller::class)->only('create','store', 'edit', 'update', 'destroy');
    Route::resource('role', RoleController::class)->middleware('role:super-admin');
});
