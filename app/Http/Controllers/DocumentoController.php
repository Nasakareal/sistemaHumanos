<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index(Empleado $empleado)
    {
        $tipos = Documento::tiposPredefinidos();
        $empleado->load('documentos');
        return view('documentos.index', compact('empleado', 'tipos'));
    }


    public function create(Empleado $empleado)
    {
        return view('documentos.create', compact('empleado'));
    }

    public function store(Request $request, Empleado $empleado)
    {
        $request->validate([
            'tipo'           => 'required|string|max:255',
            'fecha_entrega'  => 'nullable|date',
            'observaciones'  => 'nullable|string|max:255',
            'vigente'        => 'nullable|boolean',
            'archivo'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $rutaArchivo = null;
        if ($request->hasFile('archivo')) {
            $rutaArchivo = $request->file('archivo')->store('documentos', 'public');
        }

        Documento::create([
            'empleado_id'    => $empleado->id,
            'tipo'           => $request->tipo,
            'fecha_entrega'  => $request->fecha_entrega,
            'observaciones'  => $request->observaciones,
            'vigente'        => $request->boolean('vigente', true),
            'ruta_archivo'   => $rutaArchivo,
        ]);

        return redirect()->route('empleados.show', $empleado->id)
            ->with('success', 'Documento agregado correctamente.');
    }

    public function edit(Empleado $empleado, Documento $documento)
    {
        return view('documentos.edit', compact('empleado', 'documento'));
    }

    public function update(Request $request, Empleado $empleado, Documento $documento)
    {
        $request->validate([
            'tipo'           => 'required|string|max:255',
            'fecha_entrega'  => 'nullable|date',
            'observaciones'  => 'nullable|string|max:255',
            'vigente'        => 'nullable|boolean',
            'archivo'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('archivo')) {
            if ($documento->ruta_archivo) {
                Storage::disk('public')->delete($documento->ruta_archivo);
            }

            $documento->ruta_archivo = $request->file('archivo')->store('documentos', 'public');
        }

        $documento->update([
            'tipo'           => $request->tipo,
            'fecha_entrega'  => $request->fecha_entrega,
            'observaciones'  => $request->observaciones,
            'vigente'        => $request->boolean('vigente', true),
        ]);

        return redirect()->route('empleados.show', $empleado->id)
            ->with('success', 'Documento actualizado correctamente.');
    }

    public function destroy(Empleado $empleado, Documento $documento)
    {
        if ($documento->ruta_archivo) {
            Storage::disk('public')->delete($documento->ruta_archivo);
        }

        $documento->delete();

        return redirect()->route('empleados.show', $empleado->id)
            ->with('success', 'Documento eliminado correctamente.');
    }

    public function descargar(Empleado $empleado, Documento $documento)
    {
        if ($documento->ruta_archivo && Storage::disk('public')->exists($documento->ruta_archivo)) {
            return Storage::disk('public')->download($documento->ruta_archivo);
        }

        return back()->with('error', 'Archivo no encontrado.');
    }
}
