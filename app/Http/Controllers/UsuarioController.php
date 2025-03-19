<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protege la ruta con autenticación
    }

    public function index()
    {
        return view('usuarios'); // Asegúrate de que la vista exista en resources/views/usuarios.blade.php
    }
}
