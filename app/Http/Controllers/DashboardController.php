<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $adminName = Auth::check() ? Auth::user()->nombre : 'Administrador';


        // Animales totales
        $animalesTotales = Animal::count();

        // Especie más presente
        $especieMasPresente = Animal::select('especie', DB::raw('count(*) as total'))
            ->groupBy('especie')
            ->orderByDesc('total')
            ->first();
        $nombreEspecie = $especieMasPresente ? $especieMasPresente->especie : 'N/A';

        // Animal más donado 
        $animalMasDonadoData = DB::table('animal_user')
            ->select('animal_id', DB::raw('SUM(cantidad) as total_recibido'))
            ->groupBy('animal_id')
            ->orderByDesc('total_recibido')
            ->first();
        $animalMasDonado = $animalMasDonadoData ? Animal::find($animalMasDonadoData->animal_id)->nombre : 'Ninguno';

        // Trabajadores totales
        $trabajadoresTotales = User::where('es_trabaj', true)->count();

        // Cantidad más alta donada 
        $cantidadMasAlta = DB::table('animal_user')->max('cantidad') ?? 0;

        // Dinero total del santuario
        $dineroTotal = DB::table('animal_user')->sum('cantidad') ?? 0;

        //TABLA
        // Todos los animales
        $animales = Animal::all();
        
        // Todos los trabajadores
        $trabajadores = User::where('es_trabaj', true)->get();

        return view('dashboard', [
            'adminName' => $adminName,
            'stats' => [
                'animalesTotales' => $animalesTotales,
                'especieMasPresente' => $nombreEspecie,
                'animalMasDonado' => $animalMasDonado,
                'trabajadoresTotales' => $trabajadoresTotales,
                'cantidadMasAlta' => $cantidadMasAlta,
                'dineroTotal' => $dineroTotal
            ],
            'animales' => $animales,
            'trabajadores' => $trabajadores
        ]);
    }

    public function crearAnimalEjemplo()
    {
        $animal = new \App\Models\Animal();
        $animal->nombre = 'Melocotón ' . rand(1, 100); 
        $animal->grupo = 'Mamífero';
        $animal->especie = 'Perro';
        $animal->rasgos = ['Amigable', 'Juguetón', 'Glotón'];
        $animal->sexo = 'M';
        $animal->anno_nacimiento = 2004;
        $animal->tamaño = 1.54;
        $animal->peso = 12.98;
        $animal->castrado = false;
        $animal->dieta = 'Carnívoro';
        
        $animal->save();

        return back();
    }

    public function crearTrabajadorEjemplo()
    {
        $numero = rand(1, 10000);
        
        $trabajador = new \App\Models\User();
        $trabajador->nombre = 'José Fidel';
        $trabajador->apellido = 'Argudo Argudo';
        $trabajador->email = "josepro{$numero}@gmail.com";
        $trabajador->password = bcrypt('12345678');
        $trabajador->usuario = "josefidel_{$numero}";
        $trabajador->telefono = '567392201';
        $trabajador->es_trabaj = true;
        
        $trabajador->save();

        return back();
    }
}

