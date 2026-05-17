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
        // Validamos
        $credentials = $request->validate([
            'usuario'  => 'required',
            'password' => 'required',
        ], [
            'usuario.required'  => 'Debes introducir tu usuario.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // Comprobamos los datos
        if (Auth::attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['password']])) {

            $request->session()->regenerate();

            return redirect()->route('index')->with('success', 'Has iniciado sesión.');
        }

        // Si falla, volvemos atrás con un error
        return back()->withErrors([
            'usuario' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('usuario');
    }

    public function verificarRegistro(Request $request) {

        //Reglas de validación de registro
        $rules = [
            'nombre' => 'required|min:3',
            'apellidos' => 'required',
            'email' => 'required|email|unique:users,email',
            'usuario' => 'required|unique:users,usuario',
            'password' => 'required|min:8|confirmed',
        ];

        //Mensajes de error de registro
        $messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
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
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'usuario' => $request->usuario,
            'cuenta_bancaria' => $request->cuenta_bancaria ?? null,
            'es_trabaj' => $request->es_trabaj ?? false,
        ]);

        Auth::login($usuarioNuevo);

        return redirect()->route('index')->with('success', 'Has iniciado sesión.');
    }

    public function logout(Request $request){
        // Cierra la sesión del usuario
        Auth::logout();

        // Invalida la sesión actual del navegador
        $request->session()->invalidate();

        // Regenera el token CSRF para evitar ataques
        $request->session()->regenerateToken();

        // Redirige a la página principal
        return redirect()->route('index');
    }
}
