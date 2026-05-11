<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'telefono',
        'mensaje',
        'es_trabaj',
    ];
}
