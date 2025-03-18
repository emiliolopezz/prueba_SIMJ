@extends('adminlte::page')

@section('content_header')
    <br>
@stop

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <p class="mb-0">Control de proyectos.</p>

        <div class="ml-auto d-flex">
            @if($isAdmin)
                <!-- admin -->
                <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#modalProyecto">
                    <i class="fas fa-fw fa-plus"></i>
                </button>
            @endif
            <button class="btn btn-primary">
                <i class="fas fa-fw fa-file-pdf"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div id="proyectos-container">
            <!-- los proyectos se muestran aqui -->
        </div>
    </div>
</div>

<!-- modal proyecto -->
<div class="modal fade" id="modalProyecto" tabindex="-1" role="dialog" aria-labelledby="modalProyectoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProyectoLabel">Nuevo Proyecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formProyecto">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre del Proyecto</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal tareas -->
<div class="modal fade" id="modalFechaHora" tabindex="-1" role="dialog" aria-labelledby="modalFechaHoraLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFechaHoraLabel">Inicio de tarea</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formTarea">
                    <input type="hidden" id="id_proyecto">
                    
                    <label for="fecha_inicio">Fecha y Hora de Inicio:</label>
                    <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" required>
                    <br><br>
                    
                    
                    <label for="nombre_tarea">Nombre de la tarea:</label>
                    <input type="text" id="nombre_tarea" name="nombre_tarea" class="form-control" required>
                    <br><br>

                    
                    <label for="fecha_fin">Fecha y Hora de Finalización:</label>
                    <input type="datetime-local" id="fecha_fin" name="fecha_fin" required>
                    <br><br>

                    <button type="submit" class="btn btn-primary">Guardar tarea</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="calendar"></div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop

@section('js')
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/interaction/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('proyectos-container');
            var calendarEl = document.getElementById('calendar');

            // Guardar tarea cuando abre modal
            $('#formTarea').on('submit', function(event) {
                event.preventDefault(); 

                var idProyecto = $('#id_proyecto').val();
                var nombreTarea = $('#nombre_tarea').val();
                var fechaInicio = $('#fecha_inicio').val();
                var fechaFin = $('#fecha_fin').val();

                // enviar los datos
                $.ajax({
                    url: "{{ route('tareas.store') }}", 
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}", 
                        id_proyecto: idProyecto,
                        nombre_tarea: nombreTarea,
                        fecha_inicio: fechaInicio,
                        fecha_fin: fechaFin
                    },
                    success: function(response) {
                        alert('Tarea guardada correctamente');
                        $('#modalFechaHora').modal('hide'); 
                        $('#formTarea')[0].reset(); 
                        calendar.refetchEvents(); // Recargar no funciona
                        location.reload(); //recarga pagina solucion

                    },
                    error: function(xhr, status, error) {
                        alert('Hubo un error al guardar la tarea');
                        console.log(xhr.responseText);
                    }
                });
            });

            //eventos arrastrables
            new Draggable(containerEl, {
                itemSelector: '.proyecto',
                eventData: function(eventEl) {
                    return {
                        title: $(eventEl).find('p').first().text(), 
                        id: $(eventEl).data('id') 
                    };
                }
            });

            // calendario
            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                editable: true,
                droppable: true, 
                events: function(info, successCallback, failureCallback) {

                    
                    $.ajax({
                        url: '/tareas/usuario/', 
                        method: 'GET',
                        success: function(response) {
                            
                            successCallback(response);
                        },
                        error: function() {
                            failureCallback('Hubo un error al cargar las tareas');
                        }
                    });
                },
                drop: function(info) {
                    var date = info.date; 
                    var formattedDate = date.toISOString(); 
                    var projectId = $(info.draggedEl).data('id'); //id del proyecto

                    // Asignar la fecha y hora actuales como valor por defecto en el campo de fecha de inicio
                    var currentDate = new Date();
                    var currentDateTime = currentDate.toISOString().slice(0, 16); 

                   
                    $('#fecha_inicio').val(currentDateTime);
                    $('#fecha_fin').val(currentDateTime); 

                    
                    $('#id_proyecto').val(projectId);

                    
                    $('#modalFechaHora').modal('show');
                }
            });

            calendar.render();

            // Cargar los proyectos
            function cargarProyectos() {
                $.ajax({
                    url: "{{ url('/api/proyectos') }}",
                    method: 'GET',
                    success: function(response) {
                        // ordenar proyectos por la fecha del último uso
                        response.proyectos.sort(function(a, b) {
                            var fechaA = new Date(a.fecha_ultimo_uso);
                            var fechaB = new Date(b.fecha_ultimo_uso);
                            return fechaB - fechaA;
                        });

                        var proyectosHTML = '';
                        response.proyectos.forEach(function(proyecto) {
                            proyectosHTML += `
                                <div class="proyecto" data-id="${proyecto.id}">
                                    <p>${proyecto.nombre}</p>
                                    <div class="d-flex justify-content-between align-items-center">        
                                        <p class="nUSU">Creado por ${proyecto.nombre_usuario}</p>
                                        <p class="fecha">${proyecto.fecha_ultimo_uso}</p>
                                    </div>
                                </div>
                                <br>
                            `;
                        });
                        $('#proyectos-container').html(proyectosHTML);
                    },
                    error: function() {
                        alert("Hubo un error al cargar los proyectos.");
                    }
                });
            }

            cargarProyectos();
           // boton + para nuevo proyecto.
        
            
            $('#formProyecto').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                console.log(formData);

                $.ajax({
                    url: '{{ route('proyectos.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        
                        alert('Proyecto creado correctamente');
                        $('#modalProyecto').modal('hide');
                        cargarProyectos();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove(); 

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Hubo un error al crear el proyecto');
                    }
                });
            });
            
        });
    </script>
@stop

@section('footer')
<div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
    <p style="margin: 0;">&copy; 2025 </p>
    <p style="margin: 0;"> SOLUCIONES INFORMÁTICAS MJ, S.C.A.</p>
</div>
@stop
