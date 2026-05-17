<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


    public function adoptar(int $id)
    {
        $animal = Animal::findOrFail($id);

        $animal->delete();

        return back()->with(
            'deleted',
            'Animal adoptado correctamente'
        );
    }

    public function apadrinar(int $id)
    {
        if (!Auth::check()) {
            return back()->with(
                'error',
                'Debes iniciar sesión para apadrinar.'
            );
        }

        $usuario = Auth::user();

        $cantidad = rand(10, 1000) / 100;

        DB::table('animal_user')->insert([
            'user_id' => $usuario->id,
            'animal_id' => $id,
            'cantidad' => $cantidad,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with(
            'apadrinado',
            'Gracias por apadrinar con ' . number_format($cantidad, 2) . '€'
        );
    }
}
