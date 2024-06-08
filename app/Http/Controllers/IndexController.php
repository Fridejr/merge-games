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
            $userId = Auth::id();
            
            $tablero = Tablero::firstOrCreate(['user_id' => $userId], ['n_casillas' => 15]);
            $nivel = Auth::user()->nivel;
            $consolas = Consola::all();
            $dinero = Auth::user()->dinero;

            return view('index', compact('tablero', 'nivel', 'consolas', 'dinero'));

        } else {
            // Variables y datos necesarios para que la aplicacion funcione en modo invitado
            $invitado = true;
            $tablero = new Tablero();
            $tablero->n_casillas = 15;
            $nivel = 1;
            $consolas = Consola::all();
            $dinero = 0;

            return view('index', compact('tablero',  'nivel', 'consolas', 'dinero', 'invitado'));
        }
    }

    public function actualizarDatos(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);

        if ($user) {
            // Actualizar nivel y dinero del usuario
            $user->nivel = $request->input('nivel', $user->nivel);
            $user->dinero = $request->input('dinero', $user->dinero);
            $user->save();

            // Obtener o crear el tablero del usuario
            $tablero = Tablero::firstOrCreate(['user_id' => $userId], ['n_casillas' => 15]);
            $tablero->n_casillas = $request->input('n_casillas', $tablero->n_casillas);
            $tablero->save();

            // Eliminar las consolas que no se han seleccionado
            $tablerosConsolas = TablerosConsolas::where('tablero_id', $tablero->id)->get();
            foreach ($tablerosConsolas as $tablerosConsola) {
                if (!in_array($tablerosConsola->consola_id, $request->input('consolas', []))) {
                    $tablerosConsola->delete();
                }
            }

            // Actualizar la tabla "tableros_consolas"
            $consolas = $request->input('consolas', []);
            foreach ($consolas as $consola) {
                TablerosConsolas::updateOrCreate(
                    ['tablero_id' => $tablero->id, 'posicion' => $consola['posicion']],
                    ['consola_id' => $consola['consola_id']]
                );
            }

            return response()->json(['success' => true, 'message' => 'Datos actualizados correctamente']);
        }

        return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
    }

    //Funcion para incrementar el numero de casillas del tablero del jugador
    public function incrementarCasillas(Request $request)
    {
        $userId = Auth::id();
        $tablero = Tablero::where('user_id', $userId)->first();

        $tablero->n_casillas += 1;
        $tablero->save();

        return response()->json(['success' => true]);

    }

    //Funcion para añadir consolas al tablero utilizando la tabla "tableros_consolas"
    public function agregarConsola(Request $request)
    {
        try {
            $userId = Auth::id();
            $tablero = Tablero::where('user_id', $userId)->first();

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

    //Funcion para mezclar consolas, elimina la consola que se "arrastra" y modifica el id de la otra.
    public function mezclarConsolas(Request $request)
    {
        try {
            $userId = Auth::id();
            $tablero = Tablero::where('user_id', $userId)->first();

            TablerosConsolas::where('tablero_id', $tablero->id)
                            ->where('posicion', $request->posicion_origen)
                            ->delete();

            $tableroConsolaDestino = TablerosConsolas::where('tablero_id', $tablero->id)
                                                     ->where('posicion', $request->posicion_destino)
                                                     ->first();

            if ($tableroConsolaDestino) {
                $tableroConsolaDestino->consola_id = $request->id_consola;
                $tableroConsolaDestino->save();
            } 

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    //Funcion para intercambiar la posicion de las consolas en caso de que no sean iguales
    public function intercambiarConsolas(Request $request)
    {
        try {
            $userId = Auth::id();
            $tablero = Tablero::where('user_id', $userId)->first();

            $consolaOrigen = TablerosConsolas::where('tablero_id', $tablero->id)
                                                    ->where('posicion', $request->posicion_origen)
                                                    ->first();
            $consolaDestino = TablerosConsolas::where('tablero_id', $tablero->id)
                                                     ->where('posicion', $request->posicion_destino)
                                                     ->first();

            if ($consolaOrigen && $consolaDestino) {
                // Intercambia las posiciones de las consolas
                $tempConsolaId = $consolaOrigen->consola_id;
                $consolaOrigen->consola_id = $consolaDestino->consola_id;
                $consolaDestino->consola_id = $tempConsolaId;

                $consolaOrigen->save();
                $consolaDestino->save();
            } 

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    //Funcion para mover una consola de casilla
    public function actualizarPosicionConsola(Request $request)
    {
        try {
            $userId = Auth::id();
            $tablero = Tablero::where('user_id', $userId)->first();

            $tableroConsola = TablerosConsolas::where('tablero_id', $tablero->id)
                                              ->where('posicion', $request->posicion_origen)
                                              ->first();

            if ($tableroConsola) {
                $tableroConsola->posicion = $request->posicion_destino;
                $tableroConsola->save();
            } 

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    //Funcion para actualizar el nivel del jugador
    public function subirNivel()
    {
        try {
            $userId = Auth::id();

            $user = User::find($userId);
            $user->nivel += 1;
            $user->save();

            return response()->json(['success' => true, 'nivel' => $user->nivel]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    //Funcion para actualizar el dinero del jugador
    public function actualizarDinero(Request $request)
    {
        try {
            $userId = Auth::id();

            $user = User::find($userId);
            $user->dinero = $request->dinero;
            $user->save();

            return response()->json(['success' => true, 'dinero' => $user->dinero]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    //Funcion para reiniciar la partida de jugador, reestabliendo los valores iniciales y eliminando sus consolas
    public function reiniciarJuego() {
        try {
            $userId = Auth::id();

            $user = User::find($userId);
            $user->dinero = 0;
            $user->nivel = 1;
            $user->save();

            $tablero = Tablero::where('user_id', $userId)->first();
            $tablero->n_casillas = 4;
            $tablero->save();

            $consolasDelUsuario = TablerosConsolas::where('tablero_id', $tablero->id)->get();
            foreach ($consolasDelUsuario as $consola) {
                $consola->delete();
            }
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }
}

