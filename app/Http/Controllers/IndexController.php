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

        //Obtiene el numero de registros en la tabla Tablero-consolas que coincidan con el id del tablero
        $numeroConsolas = $tablero->consolas;

        // Obtiene las posiciones de las consolas en el tablero
        $posicionesConsolas = Tablero::find($tablero->id)->consolas()->orderBy('posicion')->pluck('posicion')->toArray();

        // Obtiene la imagen (ruta_imagen) de la primera consola
        $imagenConsola = Consola::first()->ruta_imagen;

        //obtiene el nivel del usuario
        $nivel = Auth::user()->nivel;

        //Obtiene todas las consolas que existen en la base de datos
        $consolas = Consola::all();

        //Obtiene el dinero del usuario
        $dinero = Auth::user()->dinero;

        return view('index', compact('tablero', 'numeroCasillas', 'numeroConsolas', 'posicionesConsolas', 'imagenConsola', 'nivel', 'consolas', 'dinero'));
        }
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

    public function agregarConsola(Request $request)
    {
        try {
            $userId = Auth::id();

            $tablero = Tablero::where('user_id', $userId)->first();

            if (!$tablero) {
                return response()->json(['error' => 'Tablero no encontrado para este usuario'], 404);
            }

            $tableroConsola = new TablerosConsolas();
            $tableroConsola->tablero_id = $tablero->id;
            $tableroConsola->consola_id = $request->id_consola;
            $tableroConsola->posicion = $request->posicion;
            $tableroConsola->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    public function mezclarConsolas(Request $request)
    {
        try {
            // Obtén el ID del usuario autenticado
            $userId = Auth::id();

            // Busca el tablero del usuario
            $tablero = Tablero::where('user_id', $userId)->first();

            if (!$tablero) {
                return response()->json(['error' => 'Tablero no encontrado para este usuario'], 404);
            }

            // Elimina la consola que se arrastra
            TablerosConsolas::where('tablero_id', $tablero->id)
                            ->where('posicion', $request->posicion_origen)
                            ->delete();

            // Actualiza la consola en la posición destino
            $tableroConsolaDestino = TablerosConsolas::where('tablero_id', $tablero->id)
                                                     ->where('posicion', $request->posicion_destino)
                                                     ->first();

            if ($tableroConsolaDestino) {
                $tableroConsolaDestino->consola_id = $request->id_consola_destino;
                $tableroConsolaDestino->save();
            } else {
                return response()->json(['error' => 'Consola no encontrada en la posición destino especificada'], 404);
            }

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }


    public function intercambiarConsolas(Request $request)
    {
        try {
            // Obtén el ID del usuario autenticado
            $userId = Auth::id();

            // Busca el tablero del usuario
            $tablero = Tablero::where('user_id', $userId)->first();

            if (!$tablero) {
                return response()->json(['error' => 'Tablero no encontrado para este usuario'], 404);
            }

            // Obtén las consolas en las posiciones de origen y destino
            $tableroConsolaOrigen = TablerosConsolas::where('tablero_id', $tablero->id)
                                                    ->where('posicion', $request->posicion_origen)
                                                    ->first();
            $tableroConsolaDestino = TablerosConsolas::where('tablero_id', $tablero->id)
                                                     ->where('posicion', $request->posicion_destino)
                                                     ->first();

            if ($tableroConsolaOrigen && $tableroConsolaDestino) {
                // Intercambia las posiciones de las consolas
                $tempConsolaId = $tableroConsolaOrigen->consola_id;
                $tableroConsolaOrigen->consola_id = $tableroConsolaDestino->consola_id;
                $tableroConsolaDestino->consola_id = $tempConsolaId;

                // Guarda los cambios
                $tableroConsolaOrigen->save();
                $tableroConsolaDestino->save();
            } else {
                return response()->json(['error' => 'Consola no encontrada en una de las posiciones especificadas'], 404);
            }

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    public function actualizarPosicionConsola(Request $request)
    {
        try {
            // Obtén el ID del usuario autenticado
            $userId = Auth::id();

            // Busca el tablero del usuario
            $tablero = Tablero::where('user_id', $userId)->first();

            if (!$tablero) {
                return response()->json(['error' => 'Tablero no encontrado para este usuario'], 404);
            }

            // Actualiza la posición de la consola
            $tableroConsola = TablerosConsolas::where('tablero_id', $tablero->id)
                                              ->where('posicion', $request->posicion_origen)
                                              ->first();

            if ($tableroConsola) {
                $tableroConsola->posicion = $request->posicion_destino;
                $tableroConsola->save();
            } else {
                return response()->json(['error' => 'Consola no encontrada en la posición de origen especificada'], 404);
            }

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    public function subirNivel()
    {
        try {
            // Obtén el ID del usuario autenticado
            $userId = Auth::id();

            // Aumentar el nivel del usuario
            $user = User::find($userId);
            $user->nivel += 1;
            $user->save();

            return response()->json(['success' => true, 'nivel' => $user->nivel]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    public function actualizarDinero(Request $request)
    {
        try {
            // Obtén el ID del usuario autenticado
            $userId = Auth::id();

            // Actualiza el dinero del usuario
            $user = User::find($userId);
            $user->dinero = $request->dinero;
            $user->save();

            return response()->json(['success' => true, 'dinero' => $user->dinero]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }
}
