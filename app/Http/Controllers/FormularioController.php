<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class FormularioController extends Controller
{
    public function index()
    {
        return view('formulario');
    }
}
