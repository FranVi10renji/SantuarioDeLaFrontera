<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animal;

class IndexController extends Controller
{
    public function index()
    {
        // 1. Cogemos todos los animales de la base de datos
        // $animales = Animal::all(); 

        // 2. Enviamos la variable a la vista 'index'
        // return view('index', compact('animales'));

        return view("index");
    }
}
