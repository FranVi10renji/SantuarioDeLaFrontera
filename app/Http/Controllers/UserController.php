<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


use App\Models\User; // Importamos el Modelo

class UserController extends Controller {
    public function mostrar(): View {
    // El Controlador le pide datos al Modelo buscando el ID 1
    $usuario = User::find(1);

    // Carga la vista 'perfil' pasando la variable 'usuario' bajo el nombre 'user'
    return view('perfil', ['user' => $usuario]);
}

    public function formularioRegistro(): View {
        return view('register');
    }

    public function formularioLogin(): View {
        return view('login');
    }

    public function verificarLogin(Request $request) {
        // 1. Validamos solo que los campos estén presentes
        $credentials = $request->validate([
            'usuario'  => 'required',
            'password' => 'required',
        ], [
            'usuario.required'  => 'Debes introducir tu usuario.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // 2. Intentamos el login
        // Auth::attempt busca al usuario por 'usuario' y comprueba la password (encriptada)
        if (Auth::attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['password']])) {

            // Si el login es correcto, regeneramos la sesión (seguridad extra contra fijación de sesión)
            $request->session()->regenerate();

            // Buscamos el objeto del usuario logueado para pasarlo a la vista
            $user = Auth::user();

            return view('dashboard', ['user' => $user])->with('success', 'Has iniciado sesión.');
            //return view('perfil', ['user' => $user])->with('success', 'Has iniciado sesión.');
        }

        // 3. Si falla, volvemos atrás con un error
        return back()->withErrors([
            'usuario' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('usuario');
    }

    public function verificarRegistro(Request $request) {

        //Reglas de validación de registro
        $rules = [
            'nombre' => 'required|min:3',
            'apellido' => 'required',
            'email' => 'required|email|unique:users,email',
            'usuario' => 'required|unique:users,usuario',
            'password' => 'required|min:8|confirmed',
        ];

        //Mensajes de error de registro
        $messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'apellido.required' => 'Los apellidos son obligatorios.',
            'email.required' => 'El correo electrónico es necesario.',
            'email.unique' => 'Este correo ya está registrado.',
            'usuario.unique' => 'El nombre de usuario ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];

        //Validación del registro
        $request->validate($rules, $messages);

        //Creación del usuario
        $usuarioNuevo = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'usuario' => $request->usuario,
            'cuenta_bancaria' => $request->cuenta_bancaria ?? null,
            'es_trabaj' => $request->es_trabaj ?? false,
        ]);

        return view('perfil', ['user' => $usuarioNuevo])->with('success', 'Usuario creado correctamente');
    }
}
