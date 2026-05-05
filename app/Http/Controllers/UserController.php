<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;


use App\Models\User; // Importamos el Modelo

class UserController extends Controller {
    public function mostrar(): View {
        // El Controlador le pide datos al Modelo
        $usuario = User::find(1); 

        // Carga la vista user/profile de la carpeta de views
        return view('user.profile', ['user' => $usuario]);
    }
}
