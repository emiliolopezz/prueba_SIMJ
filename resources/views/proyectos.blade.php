@extends('adminlte::page')

@section('title', 'Proyectos')

@section('content_header')
    <br>
@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalFiltros">
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
        </div>

        <div class="col-md-7">
            <div class="card">
                <!-- selector usuarios -->
                <div class="row">
                    <div class="col-md-12">
                        <label for="userSelector">Mi Calendario:</label>
                        <select id="userSelector" class="form-control" style="width: 200px;">
                        <option value="">Selecciona un usuario</option>
                            <!-- las opciones se muestran aqui -->
                        </select>
                    </div>
                </div>
                <!-- calendario -->
                <div id="calendar"></div>
            </div>
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

<!-- Modal de pdf -->
<div class="modal fade" id="modalFiltros" tabindex="-1" role="dialog" aria-labelledby="modalFiltrosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFiltrosLabel">Generar Informe de Tareas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formFiltro" method="GET" action="{{ route('tareas.informe') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="proyecto">Selecciona un Proyecto:</label>
                        <select id="proyecto" name="proyecto" class="form-control">
                            <!-- opciones de proyectos -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_desde">Desde fecha:</label>
                        <input type="datetime-local" id="fecha_desde" name="fecha_desde" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fecha_hasta">Hasta fecha:</label>
                        <input type="datetime-local" id="fecha_hasta" name="fecha_hasta" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="usuario">Selecciona un Usuario:</label>
                        <select id="usuario" name="usuario" class="form-control">
                            <!-- opciones de usuarios -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Generar Informe</button>
                </div>
            </form>
        </div>
    </div>
</div>



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
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/es.js"></script>



    <script>
        var calendar;
        document.addEventListener('DOMContentLoaded', function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('proyectos-container');
            var calendarEl = document.getElementById('calendar');
            cargarProyectosModal();

            // cargar los usuarios en el select
            $.ajax({
                url: "{{ route('usuarios.getAll') }}",
                type: 'GET',
                success: function(response) {
                    var userSelector = $('#userSelector');
                    response.usuarios.forEach(function(user) {
                        userSelector.append(new Option(user.name, user.id));
                    });
                    
                    var userId = {{ $userId }};  
                    console.log("id susario:",userId);
                    userSelector.val(userId);  
                    initializeCalendar();
                },
                error: function() {
                    alert("Hubo un error al cargar los usuarios.");
                }
            });

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
                        calendar.removeAllEvents();
                        calendar.refetchEvents(); 
                        //location.reload(); //recarga pagina solucion
                        cargarProyectos();

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
            
            function initializeCalendar() {
        
        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'timeGridDay',
            locale: 'es',
            editable: true,
            droppable: true,
            events: function(info, successCallback, failureCallback) {
                var userId = $('#userSelector').val();  
                console.log("selector:", userId);

                $.ajax({
                    url: '/tareas/usuario/' + userId,  
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        successCallback(response);  
                    },
                    error: function() {
                        failureCallback('Hubo un error al cargar las tareas');
                    }
                });
            },
            drop: function(info) {
                var date = info.date;
                var currentDate = new Date(date.getTime() - date.getTimezoneOffset() * 60000);
                var currentDateTime = currentDate.toISOString().slice(0, 16);
                var projectId = $(info.draggedEl).data('id');

                $('#fecha_inicio').val(currentDateTime);
                $('#fecha_fin').val(currentDateTime);
                $('#id_proyecto').val(projectId);

                $('#modalFechaHora').modal('show');
            }
        });

        // recargar los eventos cada vez que el usuario seleccione uno nuevo
        $('#userSelector').on('change', function() {
            calendar.refetchEvents();  
        });

        calendar.render();
    }


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

            // boton pdf
                        // Cargar los proyectos en el select de proyectos
                function cargarProyectosModal() {
                $.ajax({
                    url: "{{ url('/api/proyectos') }}",
                    type: 'GET',
                    success: function(response) {
                        var proyectoSelector = $('#proyecto');
                        proyectoSelector.empty();//borrar select en cada nueva entrada
                        response.proyectos.forEach(function(proyecto) {
                            proyectoSelector.append(new Option(proyecto.nombre, proyecto.id)); 
                        });
                    },
                    error: function() {
                        alert("Hubo un error al cargar los proyectos.");
                    }
                });
            };

                // Cargar los usuarios en el select de usuarios
                $.ajax({
                    url: "{{ route('usuarios.getAll') }}",
                    type: 'GET',
                    success: function(response) {
                        var usuarioSelector = $('#usuario');
                        response.usuarios.forEach(function(usuario) {
                            usuarioSelector.append(new Option(usuario.name, usuario.id));  // Agregar opción al selector
                        });
                    },
                    error: function() {
                        alert("Hubo un error al cargar los usuarios.");
                    }
                });

                //----prueba cerrar modal despues de informe
                $('#formFiltro').on('submit', function(event) {
                    alert('Informe generado correctamente');
                    $('#modalFiltros').modal('hide');
                        cargarProyectos();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                });
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
                        cargarProyectosModal();
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
