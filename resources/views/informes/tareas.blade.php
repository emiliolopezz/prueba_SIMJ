<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .totales {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Informe de Tareas</h1>
    <p><strong>Filtros aplicados:</strong></p>
    <ul>
        <li><strong>Proyecto:</strong> {{ $filtros['proyecto'] ?? 'Todos' }}</li>
        <li><strong>Fecha Desde:</strong> {{ $filtros['fecha_desde'] ?? 'No especificada' }}</li>
        <li><strong>Fecha Hasta:</strong> {{ $filtros['fecha_hasta'] ?? 'No especificada' }}</li>
        <li><strong>Usuario:</strong> {{ $filtros['usuario'] ?? 'Todos' }}</li>
    </ul>

    <h2>Tareas</h2>
    @foreach ($proyectos as $proyecto)
        <h3>{{ $proyecto->nombre }}</h3>
        <table>
            <thead>
                <tr>
                    <th>Tarea</th>
                    <th>Usuario</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Tiempo (minutos)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tareas->where('proyecto_id', $proyecto->id) as $tarea)
                    <tr>
                        <td>{{ $tarea->nombre_tarea }}</td>
                        <td>{{ $tarea->usuario->name }}</td>
                        <td>{{ $tarea->fecha_inicio }}</td>
                        <td>{{ $tarea->fecha_fin }}</td>
                        <td>{{ $tarea->fecha_fin->diffInMinutes($tarea->fecha_inicio) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="totales">Tiempo total del proyecto: {{ $proyecto->total_tiempo }} minutos</p>
    @endforeach
</body>
</html>
