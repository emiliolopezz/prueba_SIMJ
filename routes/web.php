<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/proyectos', [App\Http\Controllers\ProyectoController::class, 'index'])->name('proyectos');
Route::get('/api/proyectos', [ProyectoController::class, 'getAll']);
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
Route::get('/tareas/usuario/{userId}', [TareaController::class, 'getTareasPorUsuario']);
Route::get('/user', [ProyectoController::class, 'getAllUsuarios'])->name('usuarios.getAll');
Route::get('/informe/tareas', [InformeController::class, 'generarInforme'])->name('tareas.informe');
//ruta controlada solo por administrador
Route::post('/proyectos', [ProyectoController::class, 'store'])->middleware(AdminMiddleware::class)->name('proyectos.store');
// Rutas para el CRUD de usuarios
Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario')->middleware('auth');
Route::get('/usuarios', [UsuarioController::class, 'getAllUsuarios']);
Route::post('/usuarios/crear', [UsuarioController::class, 'store']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
Route::put('/usuarios/{id}/editar', [UsuarioController::class, 'editar']);


