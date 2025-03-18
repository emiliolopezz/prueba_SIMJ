@extends('adminlte::page')



@section('content_header')
    <h1>Proyectos</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <p class="mb-0">Control de proyectos.</p>

        <div class="ml-auto d-flex">
            @if($isAdmin)
                <!-- Botón visible solo para administradores -->
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
    <!-- <div class="proyecto">
        <p>nombre proyecto</p>
        <div class="d-flex justify-content-between align-items-center">        
            <p class="nUSU">creado por usuario</p>
            <p class="fecha">fecha</p>
    </div> -->
    <div id="proyectos-container">
    <!-- los proyectos se cargan aqui -->
    </div>
    </div>
    </div>

</div>
    
@stop

<!-- modal -->
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
<!-- modal -->
@section('css')
    {{-- Añadir la hoja de estilos personalizada --}}
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop


@section('js')
    <script> 
                //boton + para nuevo proyecto.
                $(document).ready(function() {
            
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

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Hubo un error al crear el proyecto');
                    }
                });
            });
        });
    </script>
    
    <script>
        // cargar proyectos
                $(document).ready(function() {
            function cargarProyectos() {
                $.ajax({
                    url: "{{ url('/api/proyectos') }}",
                    method: 'GET',
                    success: function(response) {
                        var proyectosHTML = '';
                        
                        response.proyectos.forEach(function(proyecto) {
                            console.log(proyecto.nombre);
                            proyectosHTML += `
                                <div class="proyecto">
                                    <p>${proyecto.nombre}</p>
                                    <div class="d-flex justify-content-between align-items-center">        
                                        <p class="nUSU">Creado por ${proyecto.nombre_usuario}</p>
                                        <p class="fecha">${proyecto.fecha_ultimo_uso}</p>
                                    </div>
                                </div>
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
        });



    </script>
@stop

@section('footer')
<div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
    <p style="margin: 0;">&copy; 2025 </p>
    <p style="margin: 0;"> SOLUCIONES INFORMÁTICAS MJ, S.C.A.</p>
</div>
@stop