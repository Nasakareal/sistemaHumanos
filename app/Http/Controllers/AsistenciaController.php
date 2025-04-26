<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $query = Asistencia::with('empleado');

        if ($request->filled('fecha')) {
            $query->where('fecha', $request->input('fecha'));
        }

        $asistencias = $query->orderBy('fecha', 'desc')->orderBy('hora_entrada', 'asc')->get();

        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        return view('asistencias.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'empleado_id'   => 'required|exists:empleados,id',
            'fecha'         => 'required|date',
            'hora_entrada'  => 'nullable|date_format:H:i:s',
            'hora_salida'   => 'nullable|date_format:H:i:s',
            'estado'        => 'required|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        Asistencia::create($validatedData);

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia registrada exitosamente.');
    }

    public function show(Asistencia $asistencia)
    {
        $asistencia->load('empleado');
        return view('asistencias.show', compact('asistencia'));
    }

    public function edit(Asistencia $asistencia)
    {
        $empleados = Empleado::all();
        return view('asistencias.edit', compact('asistencia', 'empleados'));
    }

    public function update(Request $request, Asistencia $asistencia)
    {
        $validatedData = $request->validate([
            'observaciones' => 'nullable|string',
        ]);

        $asistencia->update($validatedData);

        return redirect()->route('asistencias.index')
            ->with('success', 'Observaciones actualizadas exitosamente.');
    }


    public function destroy(Asistencia $asistencia)
    {
        $asistencia->delete();

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia eliminada exitosamente.');
    }
}
