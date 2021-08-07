<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Afiliado extends Model
{
    // protected $table = 'afiliado';
    protected $primaryKey = 'idAfiliado';
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'telefono',
        'localidad',
        'cantidadHijos',
        'tipoEmpleado'
    ];
    //relacion 1 a muchos con la tabla Asignacion
    public function asignaciones(){
        return $this->hasMany(Asignacion::class, 'fkIdAfiliado', 'idAfiliado');
    }
}
