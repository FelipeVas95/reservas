<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\WorkspacesController;
use Illuminate\Support\Facades\Auth;

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
    return view('home');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    //mostrar formulario reservas
    Route::get('/booking_create', [BookingController::class, 'create'])->name('booking.create');
    //guardar formulario reservas
    Route::post('/booking_create', [BookingController::class, 'store'])->name('booking.save');
    //gestionar reservas
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/workspaces', [WorkspacesController::class, 'index'])->name('workspaces.index');
    Route::post('/create_workspaces', [WorkspacesController::class, 'store'])->name('workspaces.create');
    //eliminar salas
    Route::delete('workspaces/{id}', [WorkspacesController::class, 'destroy'])->name('workspaces.delete');
    //eliminar reservas
    Route::delete('booking/{id}', [BookingController::class, 'destroy'])->name('booking.delete');
    //cambiar estados a las reservas
    Route::post('edit_booking/{booking_id}/{status}', [BookingController::class, 'edit'])->name('booking.edit');
    //actualizar salas
    Route::put('/workspace_update/{id}', [WorkspacesController::class, 'update'])->name('workspaces.update');
    //actualizar reservas
    Route::put('/booking_update/{id}', [BookingController::class, 'update'])->name('booking.update');


    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
