<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    // protected $table = 'kit';
    protected $primaryKey = 'idKit';
    protected $fillable = [
        'nivel',
        'descripcion',
        'stock'
    ];

    //relacion 1 a muchos con la tabla Asignacion
    public function asignaciones(){
        return $this->hasMany(Asignacion::class, 'fkIdKit', 'idKit');
    }
}
