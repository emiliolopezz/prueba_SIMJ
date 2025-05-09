<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;


class ProyectoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $isAdmin = auth()->check() && auth()->user()->is_admin;

        return view('proyectos', [
            'userId' => auth()->user()->id,
            'isAdmin' => $isAdmin
        ]);
    }

    public function getAllUsuarios()
    {

        $usuarios = User::all();


        return response()->json([
            'usuarios' => $usuarios
        ]);
    }

    //metodo para guardar proyectos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $proyecto = Proyecto::create([
            'nombre' => $request->nombre,
            'id_usuario' => auth()->user()->id,
            'fecha_inicio' => today(),
        ]);

        if ($proyecto) {
            return response()->json([
                'success' => 'Proyecto creado correctamente'
            ]);
        } else {
            return response()->json([
                'error' => 'Error al crear el proyecto'
            ]);
        }
    }

    public function getAll()
    {

        $proyectos = DB::table('proyectos')
            ->join('users', 'proyectos.id_usuario', '=', 'users.id')
            ->select('proyectos.*', 'name as nombre_usuario')
            ->get();

        return response()->json(['proyectos' => $proyectos]);
    }
}
