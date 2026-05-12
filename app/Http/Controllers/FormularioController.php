<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\User;

class FormularioController extends Controller
{
    public function index()
    {
        return view('formulario');
    }

    public function storevoluntario(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'nullable|string|max:9',
            'mensaje' => 'nullable|string|max:200',
        ]);

        // Promocionar usuario a trabajador actualizando atributo en BD
        User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'mensaje' => $request->mensaje,
            // Creo que hay que ponerle un numerito como que ahora el user se promociona a voluntario
            'es_trabaj' => 1, // No sé exactamente si era (0 user; 1 trabajador; 2 admin) ???
        ]);

        return back()->with('success', 'Datos enviados correctamente');
    }

    public function storeanimal(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'grupo' => 'required|string',
            'especie' => 'required|string',
            'nacimiento' => 'required|integer|min:1970|max:2026',
            'sexo' => 'required|in:macho,hembra',
            'tamaño' => 'required|numeric',
            'peso' => 'required|numeric',
            'castrado' => 'required|in:si,no',
            'alimentacion' => 'required|string',
            'imagen' => 'nullable|image',
        ]);

        // Procesamiento de img
        $rutaImagen = null;
        if ($request->hasFile('imagen'))
            $rutaImagen = $request->file('imagen')->store('img/animals', 'public');

        // Checkboxes
        $atributos = $request->atributos ? implode(',', $request->atributos) : null;

        // Subir a la BD
        Animal::create([
            'nombre' => $request->nombre,
            'grupo' => $request->grupo,
            'especie' => $request->especie,
            'nacimiento' => $request->nacimiento,
            'sexo' => $request->sexo,
            'tamaño' => $request->tamaño,
            'peso' => $request->peso,
            'castrado' => $request->castrado,
            'alimentacion' => $request->alimentacion,
            'imagen' => $rutaImagen,
            'atributos' => $atributos,
        ]);

        return back()->with('success', 'Animal guardado correctamente');
    }
    
}
