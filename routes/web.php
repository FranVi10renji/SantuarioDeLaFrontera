<?php

// Para usar un metodo de una clase hay que añadirlo primero:

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CookieController;


// Route::get('/', function () { 
//     return view('index'); 
// });


// El primer parámetro es la ruta a la que se accede (/) y luego la clase (IndexController) y el metodo (mostrar) de la clase al que accedemos
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/formulario', [FormularioController::class, 'index'])->name('formulario');
Route::get('/perfil', [UserController::class, 'mostrar']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Formularios
Route::post('/formulario/voluntarios', [FormularioController::class, 'storevoluntario'])->name('subirvoluntario');
Route::post('/formulario/animal', [FormularioController::class, 'storeanimal'])->name('subiranimal');

// Cookies
Route::post('/aceptar-cookies', [CookieController::class, 'aceptar']);
Route::post('/rechazar-cookies', [CookieController::class, 'rechazar']);

//Dashboard
//crear ejemplos
Route::post('/dashboard/animal-ejemplo', [App\Http\Controllers\DashboardController::class, 'crearAnimalEjemplo'])->name('dashboard.animal.ejemplo');
Route::post('/dashboard/trabajador-ejemplo', [App\Http\Controllers\DashboardController::class, 'crearTrabajadorEjemplo'])->name('dashboard.trabajador.ejemplo');
//eliminar individuales
Route::delete('/dashboard/animal/{id}', [App\Http\Controllers\DashboardController::class, 'eliminarAnimal'])->name('dashboard.animal.eliminar');
Route::delete('/dashboard/trabajador/{id}', [App\Http\Controllers\DashboardController::class, 'eliminarTrabajador'])->name('dashboard.trabajador.eliminar');
//eliminar TODO
Route::delete('/dashboard/animales/eliminar-todo', [App\Http\Controllers\DashboardController::class, 'eliminarTodosAnimales'])->name('dashboard.animales.eliminar_todo');
Route::delete('/dashboard/trabajadores/eliminar-todo', [App\Http\Controllers\DashboardController::class, 'eliminarTodosTrabajadores'])->name('dashboard.trabajadores.eliminar_todo');
//actualizar
Route::put('/dashboard/animal/actualizar', [App\Http\Controllers\DashboardController::class, 'actualizarAnimal'])->name('dashboard.animal.actualizar');
Route::put('/dashboard/trabajador/actualizar', [App\Http\Controllers\DashboardController::class, 'actualizarTrabajador'])->name('dashboard.trabajador.actualizar');

//Login y registros
Route::get('/register', [UserController::class, 'formularioRegistro'])->name('formularioRegistro');
Route::get('/login', [UserController::class, 'formularioLogin'])->name('formularioLogin');
Route::post('/register', [UserController::class, 'verificarRegistro'])->name('verificarRegistro');
Route::post('/login', [UserController::class, 'verificarLogin'])->name('verificarLogin');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');