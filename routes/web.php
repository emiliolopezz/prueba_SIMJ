<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/proyectos', [App\Http\Controllers\ProyectoController::class, 'index'])->name('proyectos');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
//Route::get('/proyectos', [ProyectoController::class, 'getAll']);
Route::get('/api/proyectos', [ProyectoController::class, 'getAll']);  // Nueva ruta para la API
