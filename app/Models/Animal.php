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

    protected $casts = [
        'rasgos' => 'array',
        'castrado' => 'boolean',
    ];

    public function donantes()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}
