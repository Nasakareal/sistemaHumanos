<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function registrar(Request $request)
    {
        // Permitir llamadas desde el ESP32
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Content-Type');

        // UID en mayúsculas
        $uid = strtoupper($request->input('uid'));

        if (!$uid) {
            return response()->json([
                'status'     => 'error',
                'mensaje'    => 'UID vacío',
                'autorizado' => false
            ], 400);
        }

        // Buscar empleado por UID
        $empleado = Empleado::where('rfid_uid', $uid)->first();
        if (!$empleado) {
            return response()->json([
                'status'     => 'error',
                'mensaje'    => 'Empleado no encontrado',
                'autorizado' => false
            ], 404);
        }

        $hoy       = Carbon::today()->toDateString();
        $ahora     = Carbon::now()->toTimeString();

        // 1) Buscamos si hay un ciclo abierto (sin hora_salida) hoy
        $cicloAbierto = Asistencia::where('empleado_id', $empleado->id)
            ->where('fecha', $hoy)
            ->whereNull('hora_salida')
            ->orderBy('hora_entrada', 'desc')
            ->first();

        if ($cicloAbierto) {
            // 2) Si existe, registramos la salida y cerramos el ciclo
            $cicloAbierto->hora_salida = $ahora;
            $cicloAbierto->estado      = 'completa';
            $cicloAbierto->save();

            return response()->json([
                'status'     => 'ok',
                'mensaje'    => 'Salida registrada',
                'autorizado' => true
            ]);
        }

        // 3) Si no había ciclo abierto, iniciamos uno nuevo (entrada)
        Asistencia::create([
            'empleado_id'   => $empleado->id,
            'fecha'         => $hoy,
            'hora_entrada'  => $ahora,
            'estado'        => 'pendiente'
        ]);

        return response()->json([
            'status'     => 'ok',
            'mensaje'    => 'Entrada registrada',
            'autorizado' => true
        ]);
    }
}
