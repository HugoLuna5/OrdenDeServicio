<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'prioridad',
        'estado',
        'solicitanteId',
        'recibidoPor',
        'atendidoPor',
        'departamentoId',
        'descripcion'
    ];

    public function departamento(){
        return $this->hasOne('App\Models\Departamento', 'id', 'departamentoId');
    }

    public function recibida(){
        return $this->hasOne('App\Models\User', 'id', 'recibidoPor');
    }

    public function atiende(){
        return $this->hasOne('App\Models\User', 'id', 'atendidoPor');
    }


    public function solicitante(){
        return $this->hasOne('App\Models\User', 'id', 'solicitanteId');
    }


}
