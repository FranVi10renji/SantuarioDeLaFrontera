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

        $animalesTotales = Animal::count();

        $especieMasPresente = Animal::select('especie', DB::raw('count(*) as total'))
            ->groupBy('especie')
            ->orderByDesc('total')
            ->first();
        $nombreEspecie = $especieMasPresente ? $especieMasPresente->especie : 'N/A';

        $animalMasDonadoData = DB::table('animal_user')
            ->select('animal_id', DB::raw('SUM(cantidad) as total_recibido'))
            ->groupBy('animal_id')
            ->orderByDesc('total_recibido')
            ->first();
        $animalMasDonado = $animalMasDonadoData ? Animal::find($animalMasDonadoData->animal_id)->nombre : 'Ninguno';

        $trabajadoresTotales = User::where('es_trabaj', true)->count();

        $cantidadMasAlta = DB::table('animal_user')->max('cantidad') ?? 0;

        $dineroTotal = DB::table('animal_user')->sum('cantidad') ?? 0;

        $queryAnimales = Animal::query();

        if ($request->has('orden_animal')) {
            $direccion = $request->dir_animal ?? 'asc';
            $queryAnimales->orderBy($request->orden_animal, $direccion);
        } else {
            $queryAnimales->orderByDesc('id');
        }

        if (!$request->has('todos_animales')) {
            $queryAnimales->take(5);
        }

        $animales = $queryAnimales->get();
        

        //Lógica para los Trabajadores
        $queryTrabajadores = User::where('es_trabaj', true);

        if ($request->has('orden_trabajador')) {
            $direccion = $request->dir_trabajador ?? 'asc';
            $queryTrabajadores->orderBy($request->orden_trabajador, $direccion);
        } else {
            $queryTrabajadores->orderByDesc('id');
        }

        if (!$request->has('todos_trabajadores')) {
            $queryTrabajadores->take(5);
        }

        $trabajadores = $queryTrabajadores->get();

        //Gráfica sexos
        $graficaSexo = Animal::select('sexo', DB::raw('count(*) as total'))
            ->groupBy('sexo')
            ->pluck('total', 'sexo')
            ->toArray();

        //Gráfica especies
        $graficaEspecies = Animal::select('especie', DB::raw('count(*) as total'))
            ->groupBy('especie')
            ->pluck('total', 'especie')
            ->toArray();

        //Gráfica atributos
        $graficaRasgos = Animal::whereNotNull('atributos')
            ->get()
            ->pluck('atributos')
            ->collapse()
            ->countBy()
            ->sortDesc()
            ->take(7) 
            ->toArray();

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
            'trabajadores' => $trabajadores,
            'graficaSexo' => $graficaSexo,
            'graficaEspecies' => $graficaEspecies,
            'graficaRasgos' => $graficaRasgos
        ]);
    }

    public function crearAnimalEjemplo()
    {
        $animal = new \App\Models\Animal();
        $animal->nombre = 'Melocotón ' . rand(1, 100); 
        $animal->grupo = 'Mamífero';
        $animal->especie = 'Perro';
        $animal->atributos = ['sociable', 'territorial'];
        $animal->sexo = 'M';
        $animal->nacimiento = 2004;
        $animal->tamaño = 1.54;
        $animal->peso = 12.98;
        $animal->castrado = false;
        $animal->alimentacion = 'Carnívoro';
        
        $animal->save();

        return back();
    }

    public function crearTrabajadorEjemplo()
    {
        $numero = rand(1, 10000);
        
        $trabajador = new \App\Models\User();
        $trabajador->nombre = 'Francisco Javier';
        $trabajador->apellido = 'Rosa Vega';
        $trabajador->email = "Javirosi{$numero}@gmail.com";
        $trabajador->password = bcrypt('12345678');
        $trabajador->usuario = "javiiirsaV{$numero}";
        $trabajador->telefono = '567392201';
        $trabajador->es_trabaj = true;
        
        $trabajador->save();

        return back();
    }

    public function eliminarAnimal(int $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return back();
    }

    public function eliminarTrabajador(int $id)
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

        // Si el campo que llega es 'imagen', tratamos el $valor como un archivo
        if ($campo === 'imagen' && $request->hasFile('valor'))
            $animal->imagen = $request->file('valor')->store('img/animals', 'public');
        else
            $animal->$campo = $valor; // Para cualquier otro campo (nombre, especie, etc.)

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

