<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function registrar(Request $request)
    {
        // Headers para permitir acceso desde el ESP32
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Content-Type');

        $uid = strtoupper($request->input('uid'));

        if (!$uid) {
            return response()->json([
                'status' => 'error',
                'mensaje' => 'UID vacío',
                'autorizado' => false
            ], 400);
        }

        $empleado = Empleado::where('rfid_uid', $uid)->first();

        if (!$empleado) {
            return response()->json([
                'status' => 'error',
                'mensaje' => 'Empleado no encontrado',
                'autorizado' => false
            ], 404);
        }

        $fecha = Carbon::now()->toDateString();
        $horaActual = Carbon::now()->toTimeString();

        // Verifica si ya tiene asistencia hoy
        $asistencia = Asistencia::where('empleado_id', $empleado->id)
            ->where('fecha', $fecha)
            ->first();

        if ($asistencia) {
            if (!$asistencia->hora_salida) {
                $asistencia->hora_salida = $horaActual;
                $asistencia->estado = 'completa';
                $asistencia->save();

                return response()->json([
                    'status' => 'ok',
                    'mensaje' => 'Salida registrada',
                    'autorizado' => true
                ]);
            } else {
                return response()->json([
                    'status' => 'ok',
                    'mensaje' => 'Asistencia ya completada',
                    'autorizado' => true
                ]);
            }
        } else {
            // Registrar entrada
            Asistencia::create([
                'empleado_id' => $empleado->id,
                'fecha' => $fecha,
                'hora_entrada' => $horaActual,
                'estado' => 'pendiente'
            ]);

            return response()->json([
                'status' => 'ok',
                'mensaje' => 'Entrada registrada',
                'autorizado' => true
            ]);
        }
    }
}
