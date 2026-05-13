<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;


use App\Models\User; // Importamos el Modelo

class UserController extends Controller {
    public function mostrar(): View {
        // El Controlador le pide datos al Modelo
        $usuario = User::find(1); 

        // Carga la vista user/perfil de la carpeta de views
        return view('perfil', ['user' => $usuario]);
    }

    public function registrar(): View {
        return view('register');
    }

    public function loguear(): View {
        return view('login');
    }

    public function verificardatos(Request $request) {

        // 1. Validar lo que llega del formulario
        $request->validate([
            'nombre' => 'required|min:3',
            'apellidos' => 'required',
            'email' => 'required|email|unique:users,email',
            'usuario' => 'required|unique:users,username', // Suponiendo que tu columna se llama username
            'password' => 'required|min:8|confirmed', // 'confirmed' obliga a que password_confirmation coincida
        ]);

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar siempre
        ]);

        return "¡Datos verificados y listos para guardar!";
    }
}
