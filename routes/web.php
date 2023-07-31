<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MainController;

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
//Route::resource('ticket', TicketController::class);
// Route::group(['middleware' => ['role:admin,manager']], function () {
//     Route::resource('ticket', TicketController::class);
// });

Route::middleware(['auth'])->group(function () {
    // Route::get('ticket', TicketController::class, 'index')->middleware('can:show ticket')->name('ticket.index');
    // Route::get('ticket/create', TicketController::class, 'create')->middleware('can:create ticket')->name('ticket.create');
    // Route::post('ticket', TicketController::class, 'store')->middleware('can:create ticket')->name('ticket.store');
    // Route::get('ticket/{ticket}', TicketController::class, 'show')->middleware('can:show ticket')->name('ticket.show');
    // Route::get('ticket/{ticket}/edit', TicketController::class, 'edit')->middleware('can:update ticket')->name('ticket.edit');
    // Route::patch('ticket/{ticket}', TicketController::class, 'update')->middleware('can:update ticket')->name('ticket.update');
    // Route::delete('ticket/{ticket}', TicketController::class, 'destroy')->middleware('can:destroy ticket')->name('ticket.destroy');
    Route::resource('ticket', RoleController::class);
    Route::resource('role', RoleController::class)->middleware('role:super-admin');
});
