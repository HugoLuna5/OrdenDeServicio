<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
      'nombre'
    ];

    public function ordenes() {
        return $this->hasMany('App\Models\OrdenServicio', 'departamentoId', 'id');
    }

}
