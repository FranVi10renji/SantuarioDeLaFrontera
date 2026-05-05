<?php

// Para usar un metodo de una clase hay que añadirlo primero:

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\IndexController;

/*
Route::get('/', function () { 
    return view('welcome'); 
});
*/

// El primer parametro es la ruta a la que se accede (/perfil) y luego la clase (UserController) y el metodo (mostrar) de la clase al que accedemos
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/formulario', [FormularioController::class, 'index'])->name('formulario');
Route::get('/perfil', [UserController::class, 'mostrar']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');