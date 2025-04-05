@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
<h1>Inicio</h1>
@stop

@section('content')
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="card">
    <div class="card-header">
        <h2>Prueba técnica SIMJ</h2>
    </div>
    <div class="card-body">
        <p>Realizada por:</p>
        <h4>EMILIO LOPEZ LEON</h4>
    </div>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
<link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop

@section('footer')
<div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
    <p style="margin: 0;">&copy; 2025 </p>
    <p style="margin: 0;"> SOLUCIONES INFORMÁTICAS MJ, S.C.A.</p>
</div>
@stop