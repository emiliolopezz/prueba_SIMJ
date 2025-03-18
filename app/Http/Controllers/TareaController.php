<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use Illuminate\Support\Facades\DB;
use Auth;

class TareaController extends Controller
{
    public function getTareasPorUsuario()
    {
        $userId = auth()->id();
        // Recuperar tareas del usuario
        $tareas = Tarea::where('id_usuario', $userId)->get();

        // Formatear las tareas para que sean compatibles con FullCalendar
        $eventos = $tareas->map(function($tarea) {
            return [
                'title' => $tarea->tarea,
                'start' => $tarea->fecha_inicio,
                'end' => $tarea->fecha_fin,
                'id_proyecto' => $tarea->id_proyecto,
            ];
        });

        // Devolver las tareas como JSON
        return response()->json($eventos);
    }

    //metodo para guardar tareas
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'id_proyecto' => 'required|exists:proyectos,id', // Asegúrate de que el proyecto exista
            'nombre_tarea' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        // Crear la tarea en la base de datos
        $tarea = new Tarea();
        $tarea->id_usuario = auth()->id(); // Si el usuario está autenticado
        $tarea->tarea = $validated['nombre_tarea'];
        $tarea->id_proyecto = $validated['id_proyecto'];
        $tarea->fecha_inicio = $validated['fecha_inicio'];
        $tarea->fecha_fin = $validated['fecha_fin'];
        $tarea->save();

        return response()->json(['message' => 'Tarea guardada correctamente']);
    }

}
