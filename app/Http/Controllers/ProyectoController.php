<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;


class ProyectoController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         // verificar si usuario es admin
        $isAdmin = auth()->check() && auth()->user()->is_admin;
        return view('proyectos', compact('isAdmin'));

    }

    public function store(Request $request)
{
    // Validación de los datos
    $request->validate([
        'nombre' => 'required|string|max:255',
    ]);

    // Crear el proyecto
    $proyecto = Proyecto::create([
        'nombre' => $request->nombre,
        'id_usuario' => auth()->user()->id,
        'fecha_inicio' => today(),
    ]);

    // Devolver respuesta (si es necesario)
    if ($proyecto) {
        return response()->json([
            'success' => 'Proyecto creado correctamente'
        ]);
    } else {
        return response()->json([
            'error' => 'Error al crear el proyecto'
        ]);
    }
}

}
