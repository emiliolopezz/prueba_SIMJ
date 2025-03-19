<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\User;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class InformeController extends Controller
{
    public function generarInforme(Request $request)
    {
        // Validar los filtros
        $validated = $request->validate([
            'proyecto' => 'nullable|exists:proyectos,id',
            'fecha_desde' => 'nullable|date',
            'fecha_hasta' => 'nullable|date',
            'usuario' => 'nullable|exists:users,id',
        ]);

        // Obtener tareas filtradas
        $query = Tarea::query();

        if ($request->filled('proyecto')) {
            $query->where('id', $request->proyecto);
        }

        if ($request->filled('fecha_desde')) {
            $query->where('fecha_inicio', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->where('fecha_fin', '<=', $request->fecha_hasta);
        }

        if ($request->filled('usuario')) {
            $query->where('id_usuario', $request->usuario);
        }

        $tareas = $query->with('proyecto', 'usuario')->get();

        // Calcular el tiempo total por proyecto
        $proyectos = $tareas->groupBy('proyecto_id');

        foreach ($proyectos as $proyectoId => $tareasProyecto) {
            $proyecto = Proyecto::find($proyectoId);
            $totalTiempo = 0;

            foreach ($tareasProyecto as $tarea) {
                $tiempoTarea = $tarea->fecha_fin->diffInMinutes($tarea->fecha_inicio);
                $totalTiempo += $tiempoTarea;
            }

            $proyecto->total_tiempo = $totalTiempo;
        }

        // Generar el PDF
        $pdf = PDF::loadView('informes.tareas', [
            'tareas' => $tareas,
            'proyectos' => $proyectos,
            'filtros' => $validated,
        ]);

        return $pdf->download('informe_tareas.pdf');
    }
}
