<?php

namespace App\Http\Controllers;

use App\Models\Consola;
use Illuminate\Http\Request;
use App\Models\Tablero;
use App\Models\TablerosConsolas;
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

        // Obtiene las posiciones de las consolas en el tablero
        $posicionesConsolas = Tablero::find($tablero->id)->consolas()->orderBy('posicion')->pluck('posicion')->toArray();

        // Obtiene la imagen (ruta_imagen) de la primera consola
        $imagenConsola = Consola::first()->ruta_imagen;

        return view('index', compact('tablero', 'numeroCasillas', 'numeroConsolas', 'posicionesConsolas', 'imagenConsola'));
    }

    public function incrementarCasillas(Request $request)
    {
        // Obtén el ID del usuario autenticado
        $userId = Auth::id();

        // Busca el tablero del usuario
        $tablero = Tablero::where('user_id', $userId)->first();

        // Verifica si se encontró el tablero
        if ($tablero) {
            // Incrementa el número de casillas
            $tablero->n_casillas += 1;
            $tablero->save();

            // Retornar una respuesta JSON
            return response()->json(['success' => true]);
        } else {
            // Si no se encontró el tablero, devuelve un error
            return response()->json(['error' => 'Tablero no encontrado'], 404);
        }
    }

    public function añadirPosicionDeConsola(Request $request, $id_consola, $posicion)
    {
        // Obtén el ID del usuario autenticado
        $userId = Auth::id();

        // Busca el tablero del usuario
        $tablero = Tablero::where('user_id', $userId)->first();

        // Crea una nueva entrada en la tabla intermedia tableros_consolas
        $tablero->consolas()->attach($id_consola, ['posicion' => $posicion]);

        // Si necesitas hacer algo más después de añadir la consola, aquí lo harías

        return response()->json(['success' => true]);
    }
        
}
