<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function dashboardJson(Request $request)
    {
        // Ejemplo de datos, sustitúyelos por los cálculos reales de tu sistema
        $data = [
            'totalEmpleados'       => 100,
            'vacacionesPendientes' => 5,
            'documentosCompletos'  => 90,
            'proximosCumple'       => 3,
            'departamentos' => [
                'labels' => ['RRHH', 'TI', 'Ventas'],
                'data' => [40, 30, 30],
                'colors' => ['#28a745', '#ffc107', '#dc3545'],
            ],
            'vacacionesAprobadas'  => 20
        ];

        return response()->json($data);
    }
}
