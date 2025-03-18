@extends('adminlte::page')



@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
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