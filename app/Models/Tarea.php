<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'tarea',
        'id_proyecto',
        'fecha_fin',
        'fecha_inicio',
        'id_usuario',
    ];

//relacion con el modelo proyecto
    public function proyectos()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto');
    }

    //relacion con el modelo usuario
    public function usuarios()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
