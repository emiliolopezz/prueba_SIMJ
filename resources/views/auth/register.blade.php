@extends('adminlte::auth.auth-page')

@section('title', 'Registrarse')

@section('auth_header', 'Crea tu cuenta')

@section('auth_body')
<style>
            .login-page {
            background-color:  #002883;
        }
    </style>
<p class="login-box-msg">Regístrate para empezar a usar la aplicación.</p>

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombre" required autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirmar contraseña" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin" value="1">
        <label class="form-check-label" for="is_admin">
            ¿Es un administrador?
        </label>
    </div>

    <div>
        <div>
            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
        </div>
    </div>
</form>

<p class="mb-0">
    <a href="{{ route('login') }}" class="text-center">Ya tengo una cuenta</a>
</p>
@endsection
