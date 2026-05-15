<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request) 
    {
        $orden = $request->input('orden_animal', 'nombre'); 
        $direccion = $request->input('dir_animal', 'asc');

        $animales = Animal::orderBy($orden, $direccion)
                    ->paginate(9)
                    ->withQueryString();

        return view('index', compact('animales'));
    }
}
