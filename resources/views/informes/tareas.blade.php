<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Tareas Realizadas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #000;
            padding: 10px;
        }
        .header img {
            height: 50px;
        }
        .header div {
            text-align: right;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background-color: #003366;
            color: white;
            padding: 8px;
            text-align: left;
        }
        td {
            padding: 8px;
            text-align: left;
        }
        .totales {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SOLUCIONES INFORMÁTICAS MJ, S.C.A.</h1>
        <div>
            <p><strong>Desde Fecha:</strong> {{ $filtros['fecha_desde'] ?? 'No especificada' }}</p>
            <p><strong>Hasta Fecha:</strong> {{ $filtros['fecha_hasta'] ?? 'No especificada' }}</p>
            <p><strong>Proyecto:</strong> {{ $filtros['proyecto_nombre'] ?? 'Todos' }}</p>
            <p><strong>Usuario:</strong> {{ $filtros['usuario_nombre'] ?? 'Todos' }}</p>
        </div>
    </div>
    
    <h2>INFORME DE TAREAS REALIZADAS</h2>
    
    <h3>{{ $filtros['proyecto_nombre'] ?? 'Todos los Proyectos' }}</h3>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Min.</th>
            <th>Usuario</th>
            <th>Tarea Realizada</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($tareas as $tarea)
    <tr>
        <td>{{ $tarea->id }}</td>
        <td>{{ $tarea->fecha_inicio }}</td>
        <td>{{ $tarea->fecha_fin }}</td>
        <td>{{ $tarea->duracion_mins }}</td>
        <td>{{ $tarea->usuario->name }}</td>
        <td>{{ $tarea->tarea }}</td>
    </tr>
@endforeach
    </tbody>
</table>
<table>
  <tr>
    <th>Total minutos:</th>
    <td>{{ $totalMinutos }}</td>
  </tr>
</table>



    </body>
    </html>