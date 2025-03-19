<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Proyecto;
use Illuminate\Support\Facades\DB;
use Auth;

class TareaController extends Controller
{
    public function getTareasPorUsuario($userId)
    {
        
        
        $tareas = Tarea::where('id_usuario', $userId)->get();
        
        $eventos = $tareas->map(function($tarea) {
            return [
                'title' => $tarea->tarea,
                'start' => $tarea->fecha_inicio,
                'end' => $tarea->fecha_fin,
                'id_proyecto' => $tarea->id_proyecto,
            ];
        });

       
        return response()->json($eventos);
    }

    //metodo para guardar tareas
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'id_proyecto' => 'required|exists:proyectos,id',
            'nombre_tarea' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

       
        $tarea = new Tarea();
        $tarea->id_usuario = auth()->id();
        $tarea->tarea = $validated['nombre_tarea'];
        $tarea->id_proyecto = $validated['id_proyecto'];
        $tarea->fecha_inicio = $validated['fecha_inicio'];
        $tarea->fecha_fin = $validated['fecha_fin'];
        $tarea->save();

        // actualizar la fecha ultimo uso en la tabla proyectos
        $proyecto = Proyecto::find($validated['id_proyecto']);
        if ($proyecto) {
        $proyecto->fecha_ultimo_uso = date('Y-m-d', strtotime($validated['fecha_fin']));
        $proyecto->save();
    }

        return response()->json(['message' => 'Tarea guardada correctamente']);
    }

}
