<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
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

        // 1. Lógica para los Animales
        $queryAnimales = Animal::query();

        // ¿Han pedido ordenarlo?
        if ($request->has('orden_animal')) {
            $queryAnimales->orderBy($request->orden_animal, 'asc'); // asc = de la A a la Z, o menor a mayor
        } else {
            $queryAnimales->orderByDesc('id'); // Por defecto, los últimos añadidos
        }

        // ¿Han pedido mostrar todos?
        if (!$request->has('todos_animales')) {
            $queryAnimales->take(5); // Si no, limitamos a 5
        }

        $animales = $queryAnimales->get();
        

        // 2. Lógica para los Trabajadores
        $queryTrabajadores = User::where('es_trabaj', true);

        // ¿Han pedido ordenarlo?
        if ($request->has('orden_trabajador')) {
            $queryTrabajadores->orderBy($request->orden_trabajador, 'asc');
        } else {
            $queryTrabajadores->orderByDesc('id');
        }

        // ¿Han pedido mostrar todos?
        if (!$request->has('todos_trabajadores')) {
            $queryTrabajadores->take(5);
        }

        $trabajadores = $queryTrabajadores->get();

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

    public function eliminarAnimal($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return back();
    }

    public function eliminarTrabajador($id)
    {
        $trabajador = User::findOrFail($id);
        $trabajador->delete();

        return back();
    }

    public function actualizarAnimal(Request $request)
    {
        $animal = Animal::findOrFail($request->animal_id);
        
        $campo = $request->campo;
        $valor = $request->valor;

        $animal->$campo = $valor;
        $animal->save();

        return back();
    }

    public function actualizarTrabajador(Request $request)
    {
        $trabajador = User::findOrFail($request->trabajador_id);
        
        $campo = $request->campo;
        $valor = $request->valor;

        $trabajador->$campo = $valor;
        $trabajador->save();

        return back();
    }

    public function eliminarTodosAnimales()
    {
        Animal::query()->delete();

        return back();
    }

    public function eliminarTodosTrabajadores()
    {
        User::where('es_trabaj', true)
            ->where('id', '!=', Auth::id())
            ->delete();

        return back();
    }
}

