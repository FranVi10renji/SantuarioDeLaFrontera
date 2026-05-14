<?php

// Para usar un metodo de una clase hay que añadirlo primero:

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CookieController;

/*
Route::get('/', function () { 
    return view('welcome'); 
});
*/

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

//Login y registros
Route::get('/register', [UserController::class, 'formularioRegistro'])->name('formularioRegistro');
Route::get('/login', [UserController::class, 'formularioLogin'])->name('formularioLogin');
Route::post('/register', [UserController::class, 'verificarRegistro'])->name('verificarRegistro');
Route::post('/login', [UserController::class, 'verificarLogin'])->name('verificarLogin');