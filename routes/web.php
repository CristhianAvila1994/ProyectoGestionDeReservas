<?php

use App\Http\Controllers\HabitacionesController;
use App\Http\Controllers\HuespedesController;
use App\Http\Controllers\ReservasController;
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

//rutas actualizadas
//Grupo de Rutas para Habitaciones: Operaciones CRUD (Read:lectura)
Route::get('/habitaciones', [HabitacionesController::class, 'index'])->name('habitaciones.index');
Route::get('/habitaciones/create', [HabitacionesController::class, 'create'])->name('habitaciones.create');
Route::post('/habitaciones/store', [HabitacionesController::class, 'store'])->name('habitaciones.store');
Route::get('/habitaciones/edit/{id}', [HabitacionesController::class, 'edit'])->name('habitaciones.edit');
Route::post('/habitaciones/update/{id}', [HabitacionesController::class, 'update'])->name('habitaciones.update');
Route::delete('/habitaciones/destroy/{id}', [HabitacionesController::class, 'destroy'])->name('habitaciones.destroy');


//rutas actualizadas
//Grupo de Rutas para Huespedes: Operaciones CRUD (Read:lectura)
Route::get('/huespedes', [HuespedesController::class, 'index'])->name('huespedes.index');
Route::get('/huespedes/create', [HuespedesController::class, 'create'])->name('huespedes.create');
Route::post('/huespedes/store', [HuespedesController::class, 'store'])->name('huespedes.store');
Route::get('/huespedes/edit/{id}', [HuespedesController::class, 'edit'])->name('huespedes.edit');
Route::post('/huespedes/update/{id}', [HuespedesController::class, 'update'])->name('huespedes.update');
Route::delete('/huespedes/destroy/{id}', [HuespedesController::class, 'destroy'])->name('huespedes.destroy');


//rutas actualizadas
//Grupo de Rutas para Reservas: Operaciones CRUD (Read:lectura)
Route::get('/reservas', [ReservasController::class, 'index'])->name('reservas.index');
Route::get('/reservas/create', [ReservasController::class, 'create'])->name('reservas.create');
Route::post('/reservas/store', [ReservasController::class, 'store'])->name('reservas.store');
Route::get('/reservas/edit/{id}', [ReservasController::class, 'edit'])->name('reservas.edit');
Route::post('/reservas/update/{id}', [ReservasController::class, 'update'])->name('reservas.update');
Route::delete('/reservas/destroy/{id}', [ReservasController::class, 'destroy'])->name('reservas.destroy');
