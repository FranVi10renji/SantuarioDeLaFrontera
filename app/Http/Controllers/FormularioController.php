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
        $trabajador = User::findOrFail($request->trabajador_id);

        $trabajador->es_trabaj = true;
        $trabajador->save();

        return back()->with('success', 'Datos enviados correctamente');
    }

    public function storeanimal(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'grupo' => 'required|string',
            'especie' => 'required|string',
            'nacimiento' => 'required|integer|min:1970|max:2026',
            'sexo' => 'required|in:M,H',
            'tamaño' => 'required|numeric|min:0.01|max:10',
            'peso' => 'required|numeric|min:0.01|max:50',
            'castrado' => 'required|in:0,1',
            'alimentacion' => 'required|string',
            'imagen' => 'nullable|image',
            'atributos' => 'nullable|array' 
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) 
        {
            $imagen = $request->file('imagen');

            // Nombre único pero identificable
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

            // Mover archivo
            $imagen->move(public_path('img/animals'), $nombreImagen);

            // Guardar ruta en BD si quieres
            $rutaImagen = 'img/animals/' . $nombreImagen;
        }

        // $sexoAbreviado = ($request->sexo == 'hembra') ? 'h' : 'm';

        Animal::create([
            'nombre'          => $request->nombre,
            'grupo'           => $request->grupo,
            'especie'         => $request->especie,
            'nacimiento'      => $request->nacimiento, 
            'sexo'            => $request->sexo,
            'tamaño'          => $request->tamaño,
            'peso'            => $request->peso,
            'castrado'        => $request->castrado == 'si' ? 1 : 0,
            'alimentacion'    => $request->alimentacion, 
            'imagen'          => $rutaImagen,
            'atributos'       => $request->atributos ?? [],
        ]);

        return back()->with('success', 'Animal guardado correctamente');
    }
    
}
