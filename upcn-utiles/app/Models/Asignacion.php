<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'asignaciones';
    protected $primaryKey = 'idAsignacion';
    protected $fillable = [
        'fkIdAfiliado',
        'fkIdKit',
        'fkIdUsuario',
        'cantidad'
    ];

    public function afiliado(){
        return $this->belongsTo(Afiliado::class, 'fkIdAfiliado', 'idAfiliado');
    }

    public function kit(){
        return $this->belongsTo(Kit::class, 'fkIdKit', 'idKit');
    }

    public function user(){
        return $this->belongsTo(User::class, 'fkIdUsuario', 'idUsuario');
    }
}
