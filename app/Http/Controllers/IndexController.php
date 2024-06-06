<?php

namespace App\Http\Controllers;

use App\Models\Consola;
use Illuminate\Http\Request;
use App\Models\Tablero;
use App\Models\TablerosConsolas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function miVista()
    {
        $invitado = false;
        if (Auth::check()) {
            // Obtiene el ID del usuario autenticado
            $userId = Auth::id();

            // Obtiene el tablero del jugador autenticado
            if (!Tablero::where('user_id', $userId)->first()) {
                // Si no se encuentra el tablero, crea uno nuevo para ese usuario
                $tablero = new Tablero();
                $tablero->user_id = $userId;
                $tablero->save();
            }
            
            $tablero = Tablero::where('user_id', $userId)->first();
            
            // Obtiene el número de casillas del tablero del jugador autenticado
            $numeroCasillas = $tablero->n_casillas;

            // Obtiene el número de registros en la tabla Tablero-consolas que coincidan con el id del tablero
            $numeroConsolas = $tablero->consolas;

            // Obtiene las posiciones de las consolas en el tablero
            $posicionesConsolas = Tablero::find($tablero->id)->consolas()->orderBy('posicion')->pluck('posicion')->toArray();

            // Obtiene la imagen (ruta_imagen) de la primera consola
            $imagenConsola = Consola::first()->ruta_imagen;

            // Obtiene el nivel del usuario
            $nivel = Auth::user()->nivel;

            // Obtiene todas las consolas que existen en la base de datos
            $consolas = Consola::all();

            // Obtiene el dinero del usuario
            $dinero = Auth::user()->dinero;

            return view('index', compact('tablero', 'numeroCasillas', 'numeroConsolas', 'posicionesConsolas', 'imagenConsola', 'nivel', 'consolas', 'dinero', 'invitado'));
        } else {
            // Modo invitado: crea un tablero temporal o usa un tablero predeterminado
            $invitado = true;

            // Datos ficticios o predeterminados
            $tablero = new Tablero();
            $tablero->n_casillas = 4;

            $numeroCasillas = 4;
            $numeroConsolas = [];
            $posicionesConsolas = [];
            $imagenConsola = Consola::first()->ruta_imagen;
            $nivel = 1;
            $consolas = Consola::all();
            $dinero = 0;

            return view('index', compact('tablero', 'numeroCasillas', 'numeroConsolas', 'posicionesConsolas', 'imagenConsola', 'nivel', 'consolas', 'dinero', 'invitado'));
        }
    }
}

