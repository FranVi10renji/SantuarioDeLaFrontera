<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie; // Built-in de Laravel para gestionar cookies

class CookieController extends Controller
{
    public function aceptar()
    {
        Cookie::queue('cookies_consent', 'aceptado', 60 * 24); // 1 día para ejemplo

        return response()->json([
            'success' => true
        ]);
    }

    public function rechazar()
    {
        Cookie::queue('cookies_consent', 'rechazado', 60 * 24); // 1 día para ejemplo

        return response()->json([
            'success' => true
        ]);
    }
}
