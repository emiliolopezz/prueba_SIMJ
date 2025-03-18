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
                <button class="btn btn-primary mr-2">
                    <i class="fas fa-fw fa-plus"></i>
                </button>
            @endif
            <button class="btn btn-primary">
                <i class="fas fa-fw fa-file-pdf"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    <p>hola</p>
    </div>

</div>
    
@stop

@section('css')
    {{-- Añadir la hoja de estilos personalizada --}}
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop


@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

@section('footer')
<div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
    <p style="margin: 0;">&copy; 2025 </p>
    <p style="margin: 0;"> SOLUCIONES INFORMÁTICAS MJ, S.C.A.</p>
</div>
@stop