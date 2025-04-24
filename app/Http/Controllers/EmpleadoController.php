<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $query = Empleado::query();
        if ($request->filled('area_adscripcion')) {
            $query->where('area_adscripcion', $request->input('area_adscripcion'));
        }
        $empleados = $query->get();
        $totalEmpleados = Empleado::count();

        $areas = Empleado::select('area_adscripcion')
            ->distinct()
            ->pluck('area_adscripcion');

        return view('empleados.index', compact('empleados', 'totalEmpleados', 'areas'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre'                      => 'required|string|max:255',
            'puesto'                      => 'required|string|max:255',
            'area_adscripcion'            => 'nullable|string|max:255',
            'fecha_nacimiento'            => 'nullable|date',
            'lugar_nacimiento'            => 'nullable|string|max:255',
            'nss'                         => 'nullable|string|max:255',
            'correo_electronico'          => 'required|email|unique:empleados,correo_electronico',
            'rfc'                         => 'nullable|string|max:255',
            'curp'                        => 'nullable|string|max:255',
            'domicilio'                   => 'nullable|string|max:255',
            'calle'                       => 'nullable|string|max:255',
            'no_ext'                      => 'nullable|string|max:50',
            'no_int'                      => 'nullable|string|max:50',
            'colonia'                     => 'nullable|string|max:255',
            'cp'                          => 'nullable|string|max:10',
            'poblacion'                   => 'nullable|string|max:255',
            'telefono'                    => 'nullable|string|max:50',
            'celular'                     => 'nullable|string|max:50',
            'licenciatura'                => 'nullable|string|max:255',
            'cedula_licenciatura'         => 'nullable|string|max:255',
            'maestria'                    => 'nullable|string|max:255',
            'cedula_maestria'             => 'nullable|string|max:255',
            'doctorado'                   => 'nullable|string|max:255',
            'cedula_doctorado'            => 'nullable|string|max:255',
            'estado_civil'                => 'nullable|string|max:100',
            'edad_hijos'                  => 'nullable|integer|min:0',
            'alergias'                    => 'nullable|string',
            'tipo_sanguineo'              => 'nullable|string|max:5',
            'restricciones_salud'         => 'nullable|string',
            'contacto_emergencia_nombre'  => 'nullable|string|max:255',
            'contacto_emergencia_telefono'=> 'nullable|string|max:50',
            'contacto_emergencia_domicilio'=> 'nullable|string|max:255',
            'fecha_ingreso'               => 'nullable|date',
            'desempena_otro_trabajo'      => 'nullable|boolean',
            'otra_dependencia'            => 'nullable|string|max:255',
            'otro_trabajo_horario'        => 'nullable|string|max:255',
            'otro_trabajo_puesto'         => 'nullable|string|max:255',
        ]);

        Empleado::create($validatedData);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado exitosamente.');
    }

    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $validatedData = $request->validate([
            'nombre'                      => 'required|string|max:255',
            'puesto'                      => 'required|string|max:255',
            'area_adscripcion'            => 'nullable|string|max:255',
            'fecha_nacimiento'            => 'nullable|date',
            'lugar_nacimiento'            => 'nullable|string|max:255',
            'nss'                         => 'nullable|string|max:255',
            'correo_electronico'          => 'required|email|unique:empleados,correo_electronico,' . $empleado->id,
            'rfc'                         => 'nullable|string|max:255',
            'curp'                        => 'nullable|string|max:255',
            'domicilio'                   => 'nullable|string|max:255',
            'calle'                       => 'nullable|string|max:255',
            'no_ext'                      => 'nullable|string|max:50',
            'no_int'                      => 'nullable|string|max:50',
            'colonia'                     => 'nullable|string|max:255',
            'cp'                          => 'nullable|string|max:10',
            'poblacion'                   => 'nullable|string|max:255',
            'telefono'                    => 'nullable|string|max:50',
            'celular'                     => 'nullable|string|max:50',
            'licenciatura'                => 'nullable|string|max:255',
            'cedula_licenciatura'         => 'nullable|string|max:255',
            'maestria'                    => 'nullable|string|max:255',
            'cedula_maestria'             => 'nullable|string|max:255',
            'doctorado'                   => 'nullable|string|max:255',
            'cedula_doctorado'            => 'nullable|string|max:255',
            'estado_civil'                => 'nullable|string|max:100',
            'edad_hijos'                  => 'nullable|integer|min:0',
            'alergias'                    => 'nullable|string',
            'tipo_sanguineo'              => 'nullable|string|max:5',
            'restricciones_salud'         => 'nullable|string',
            'contacto_emergencia_nombre'  => 'nullable|string|max:255',
            'contacto_emergencia_telefono'=> 'nullable|string|max:50',
            'contacto_emergencia_domicilio'=> 'nullable|string|max:255',
            'fecha_ingreso'               => 'nullable|date',
            'desempena_otro_trabajo'      => 'nullable|boolean',
            'otra_dependencia'            => 'nullable|string|max:255',
            'otro_trabajo_horario'        => 'nullable|string|max:255',
            'otro_trabajo_puesto'         => 'nullable|string|max:255',
        ]);

        $empleado->update($validatedData);

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }

    // Mostrar formulario para asignar tarjeta RFID
    public function formAsignarTarjeta(Empleado $empleado)
    {
        return view('empleados.asignar_rfid', compact('empleado'));
    }

    // Guardar el UID de la tarjeta RFID en la base de datos
    public function guardarTarjeta(Request $request, Empleado $empleado)
    {
        $request->validate([
            'rfid_uid' => 'required|string|max:255|unique:empleados,rfid_uid,' . $empleado->id,
        ]);

        $empleado->update([
            'rfid_uid' => strtoupper($request->input('rfid_uid')),
        ]);

        return redirect()->route('empleados.show', $empleado)
            ->with('success', 'Tarjeta RFID asignada correctamente.');
    }
}
