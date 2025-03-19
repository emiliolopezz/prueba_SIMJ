<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TareaController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/proyectos', [App\Http\Controllers\ProyectoController::class, 'index'])->name('proyectos');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
Route::get('/api/proyectos', [ProyectoController::class, 'getAll']);
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
Route::get('/tareas/usuario/{userId}', [TareaController::class, 'getTareasPorUsuario']);
Route::get('/usuarios', [ProyectoController::class, 'getAllUsuarios'])->name('usuarios.getAll');

