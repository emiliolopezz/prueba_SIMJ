<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'id_usuario',
        'fecha_ultimo_uso',
        'fecha_inicio',
    ];

    //relacion con el modelo usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    //relacion con las tareas
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'id_proyecto');
    }
}