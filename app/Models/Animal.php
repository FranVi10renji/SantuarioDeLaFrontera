<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'nombre',
        'grupo',
        'especie',
        'nacimiento',
        'sexo',
        'tamaño',
        'peso',
        'castrado',
        'alimentacion',
        'imagen',
        'atributos'
    ];
}
