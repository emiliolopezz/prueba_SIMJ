@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1>Gestión de Usuarios</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuario">
            <i class="fas fa-plus"></i> Nuevo Usuario
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="tablaUsuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Administrador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- los usuarios se llenan aqui -->
            </tbody>
        </table>
    </div>
</div>

<!-- modal crear Usuario -->
<div class="modal fade" id="modalCrearUsuario" tabindex="-1" role="dialog" aria-labelledby="modalCrearUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearUsuarioLabel">Crear Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCrearUsuario">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="is_admin">¿Es Administrador?</label>
                        <input type="checkbox" id="is_admin" name="is_admin" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal editar Usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarUsuario">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_edit">Nombre</label>
                        <input type="text" class="form-control" id="nombre_edit" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email_edit">Email</label>
                        <input type="email" class="form-control" id="email_edit" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password_edit">Contraseña</label>
                        <input type="password" class="form-control" id="password_edit" name="password">
                    </div>
                    <div class="form-group">
                        <label for="is_admin_edit">¿Es Administrador?</label>
                        <input type="checkbox" id="is_admin_edit" name="is_admin" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    // cargar los usuarios
    function cargarUsuarios() {
        $.ajax({
            url: '/usuarios',
            method: 'GET',
            success: function(data) {
                let tbody = $('#tablaUsuarios tbody');
                tbody.empty();
                data.usuarios.forEach(function(usuario) {
                    tbody.append(`
                            <tr>
                                <td>${usuario.id}</td>
                                <td>${usuario.name}</td>
                                <td>${usuario.email}</td>
                                <td>${usuario.is_admin == 1 ? 'Si' : 'No'}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editarUsuario(${usuario.id}, '${usuario.name}', '${usuario.email}', ${usuario.is_admin})"><i class="fas fa-edit"></i> Editar</button>
                                    <button class="btn btn-danger btn-sm" onclick="eliminarUsuario(${usuario.id})"><i class="fas fa-trash"></i> Eliminar</button>
                                </td>
                            </tr>
                        `);
                });
            }
        });
    }

    // crear usuario con AJAX
    $('#modalCrearUsuario').on('hidden.bs.modal', function() {
        $('#formCrearUsuario')[0].reset();
    });

    $('#formCrearUsuario').on('submit', function(e) {
        e.preventDefault();

        let data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            nombre: $('#nombre').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            is_admin: $('#is_admin').prop('checked') ? 1 : 0
        };

        $.ajax({
            url: '/usuarios/crear',
            method: 'POST',
            data: data,
            success: function(response) {
                $('#modalCrearUsuario').modal('hide');
                cargarUsuarios();
            },
            error: function(response) {
                console.error('Error creando el usuario:', response);
            }
        });
    });

    // eliminar usuario
    function eliminarUsuario(id) {
        if (confirm("¿Seguro que deseas eliminar este usuario?")) {
            $.ajax({
                url: '/usuarios/' + id,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    cargarUsuarios();
                }
            });
        }
    }

    // cargar los datos del usuario en el modal de edición
    function editarUsuario(id, nombre, email, is_admin) {
        $('#nombre_edit').val(nombre);
        $('#email_edit').val(email);
        $('#password_edit').val('');
        $('#is_admin_edit').prop('checked', is_admin === 1);

        $('#formEditarUsuario').attr('data-action', 'edit');
        $('#formEditarUsuario').attr('data-id', id);

        $('#modalEditarUsuario').modal('show');
    }

    // editar usuario
    $('#formEditarUsuario').on('submit', function(e) {
        e.preventDefault();

        let data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            nombre: $('#nombre_edit').val(),
            email: $('#email_edit').val(),
            password: $('#password_edit').val(),
            is_admin: $('#is_admin_edit').prop('checked') ? 1 : 0
        };

        if ($(this).attr('data-action') === 'edit') {
            let id = $(this).attr('data-id');

            $.ajax({
                url: `/usuarios/${id}/editar`,
                method: 'PUT',
                data: data,
                success: function(response) {
                    $('#modalEditarUsuario').modal('hide');
                    cargarUsuarios();
                },
                error: function(response) {
                    console.error('Error editando el usuario:', response);
                }
            });
        }
    });

    // cargar usuarios al iniciar
    $(document).ready(function() {
        cargarUsuarios();
    });
</script>
@stop

@section('css')
{{-- Agrega aquí las hojas de estilo personalizadas si es necesario --}}
<link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('footer')
<div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
    <p style="margin: 0;">&copy; 2025 </p>
    <p style="margin: 0;"> SOLUCIONES INFORMÁTICAS MJ, S.C.A.</p>
</div>
@stop