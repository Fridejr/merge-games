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
            
            $tablero = Tablero::firstOrCreate(['user_id' => $userId], ['n_casillas' => 18]);
            $nivel = Auth::user()->nivel;
            $consolas = Consola::all();
            $dinero = Auth::user()->dinero;

            return view('index', compact('tablero', 'nivel', 'consolas', 'dinero'));

        } else {
            // Variables y datos necesarios para que la aplicacion funcione en modo invitado
            $invitado = true;
            $tablero = new Tablero();
            $tablero->n_casillas = 18;
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
            $tablero = Tablero::firstOrCreate(['user_id' => $userId], ['n_casillas' => 18]);
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

    //Funcion para reiniciar la partida de jugador, reestabliendo los valores iniciales y eliminando sus consolas
    public function reiniciarJuego() {
        try {
            $userId = Auth::id();

            $user = User::find($userId);
            $user->dinero = 0;
            $user->nivel = 1;
            $user->save();

            $tablero = Tablero::where('user_id', $userId)->first();
            $tablero->n_casillas = 18;
            $tablero->save();

            $consolasDelUsuario = TablerosConsolas::where('tablero_id', $tablero->id)->get();
            foreach ($consolasDelUsuario as $consola) {
                $consola->delete();
            }
            
            return response()->json(['success' => true, 'message' => 'Partida reiniciada correctamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }
}

