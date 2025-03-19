<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\User;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class InformeController extends Controller
{
    public function generarInforme(Request $request)
{
    $validated = $request->validate([
        'proyecto' => 'nullable|exists:proyectos,id',
        'fecha_desde' => 'nullable|date',
        'fecha_hasta' => 'nullable|date',
        'usuario' => 'nullable|exists:users,id',
    ]);

    // obtener el nombre del usuario
    if ($request->filled('usuario')) {
        $usuario = User::find($request->usuario);
        $validated['usuario_nombre'] = $usuario ? $usuario->name : null; 
    }

    // obtener el nombre del proyecto
    if ($request->filled('proyecto')) {
        $proyecto = Proyecto::find($request->proyecto);
        $validated['proyecto_nombre'] = $proyecto ? $proyecto->nombre : null;
    }

    //tareas filtradas--
    $query = Tarea::query();

    // Filtrar por proyecto
    if ($request->filled('proyecto')) {
        $query->where('id_proyecto', $request->proyecto);
    }


    // Filtrar por usuario
    if ($request->filled('usuario')) {
        $query->where('id_usuario', $request->usuario);
    }
    
    // Filtrar por fecha desde
    if ($request->filled('fecha_desde')) {
        $fechaDesde = Carbon::parse($request->fecha_desde)->startOfDay()->toDateString();
        $query->whereDate('fecha_inicio', '>=', $fechaDesde);
    }

    // Filtrar por fecha hasta
    if ($request->filled('fecha_hasta')) {
        $fechaHasta = Carbon::parse($request->fecha_hasta)->endOfDay()->toDateString();
        $query->whereDate('fecha_fin', '<=', $fechaHasta);
    }
 


    // tareas con la relación de proyecto y usuario
    $tareas = $query->with('proyecto', 'usuario')->get();

    // calcular los minutos para cada tarea y min totales
    foreach ($tareas as $tarea) {
        
        $fechaInicio = Carbon::parse($tarea->fecha_inicio);
        $fechaFin = Carbon::parse($tarea->fecha_fin);

        $tarea->duracion_mins = $fechaInicio->diffInMinutes($fechaFin);
    }

        $totalMinutos = $tareas->sum('duracion_mins');
    
    $pdf = PDF::loadView('informes.tareas', [
        'tareas' => $tareas,
        'filtros' => $validated,
        'totalMinutos' => $totalMinutos,
    ]);

    return $pdf->download('informe_tareas.pdf');
}

}
