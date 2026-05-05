<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () { return view('welcome'); });



// Para usar un metodo de una clase hay que añadirlo primero:
use App\Http\Controllers\UserController;

// El primer parametro es la ruta a la que se accede (/perfil) y luego la clase (UserController) y el metodo (mostrar) de la clase al que accedemos
Route::get('/perfil', [UserController::class, 'mostrar']);
