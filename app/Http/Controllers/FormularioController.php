<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        // Validación del formulario (?)

        if (Auth::check()) 
        {
            $user = Auth::user();

            if ($user instanceof User) 
            {
                $user->es_trabaj = true; // Convertimos al usuario en trabajador
                $user->save();           // Lo guardamos en la base de datos
            }
        }

        return redirect()->back()->with('success', 'Usuario convertido a trabajador.');
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
        // if ($request->hasFile('imagen')) 
        // {
        //     $imagen = $request->file('imagen');

        //     // Nombre único pero identificable
        //     $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

        //     // Mover archivo
        //     $imagen->move(public_path('img/animals'), $nombreImagen);

        //     // Guardar ruta en BD si quieres
        //     $rutaImagen = 'img/animals/' . $nombreImagen;
        // }

        if ($request->hasFile('imagen'))
            $rutaImagen = $request->file('imagen')->store('img/animals', 'public');

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
