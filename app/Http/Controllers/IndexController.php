<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animal;

class IndexController extends Controller
{
    public function index()
    {
        $animales = Animal::paginate(9); 
    
        return view('index', compact('animales'));
    }
}
