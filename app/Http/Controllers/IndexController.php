<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tablero;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function miVista()
    {
        // Obtiene el ID del usuario autenticado
        $userId = Auth::id();

        // Obtiene el tablero del jugador autenticado
        $tablero = Tablero::where('user_id', $userId)->first();

        // Obtiene el número de casillas del tablero del jugador autenticado
        $numeroCasillas = $tablero->n_casillas;

        //Obtiene el numero de registros en la tabla Tablero-consolas que coincidan con el id del tablero
        $numeroConsolas = $tablero->consolas;
        
        return view('index', compact('tablero', 'numeroCasillas', 'numeroConsolas'));

    }
}
