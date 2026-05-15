<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    // protected $table = 'SanturarioDeLaFrontera'; 
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'grupo',
        'especie',
        'anno_nacimiento',
        'sexo',
        'tamaño',
        'peso',
        'castrado',
        'dieta',
        'imagen',
        'rasgos'
    ];

    protected $casts = [
        'castrado' => 'boolean',
        'rasgos' => 'array'
    ];

    public function donantes()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}
