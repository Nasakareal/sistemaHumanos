@extends('adminlte::page')

@section('title', 'Detalles del Empleado')

@section('content_header')
    <h1>Detalles del Empleado</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados</h3>
                </div>
                <div class="card-body">

                    {{-- Fila 1: Nombre, Puesto, Área --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre</label>
                                <p class="form-control-static">
                                    {{ $empleado->nombre ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Puesto</label>
                                <p class="form-control-static">
                                    {{ $empleado->puesto ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Área de Adscripción</label>
                                <p class="form-control-static">
                                    {{ $empleado->area_adscripcion ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Fila 2: Fecha de Nac., Lugar Nac., NSS --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                <p class="form-control-static">
                                    {{ optional($empleado->fecha_nacimiento)->format('d/m/Y') ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Lugar de Nacimiento</label>
                                <p class="form-control-static">
                                    {{ $empleado->lugar_nacimiento ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NSS</label>
                                <p class="form-control-static">
                                    {{ $empleado->nss ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Fila 3: Correo, RFC, CURP --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Correo Electrónico</label>
                                <p class="form-control-static">
                                    {{ $empleado->correo_electronico ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>RFC</label>
                                <p class="form-control-static">
                                    {{ $empleado->rfc ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CURP</label>
                                <p class="form-control-static">
                                    {{ $empleado->curp ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Fila 4: Domicilio, Calle, Colonia --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Domicilio</label>
                                <p class="form-control-static">
                                    {{ $empleado->domicilio ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Calle</label>
                                <p class="form-control-static">
                                    {{ $empleado->calle ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Colonia</label>
                                <p class="form-control-static">
                                    {{ $empleado->colonia ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Fila 5: No. Ext, No. Int, CP --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Número Exterior</label>
                                <p class="form-control-static">
                                    {{ $empleado->no_ext ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Número Interior</label>
                                <p class="form-control-static">
                                    {{ $empleado->no_int ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Código Postal</label>
                                <p class="form-control-static">
                                    {{ $empleado->cp ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Fila 6: Población, Teléfono, Celular --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Población</label>
                                <p class="form-control-static">
                                    {{ $empleado->poblacion ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <p class="form-control-static">
                                    {{ $empleado->telefono ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Celular</label>
                                <p class="form-control-static">
                                    {{ $empleado->celular ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Fila 7: Licenciatura, Cédula Lic., Maestría --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Licenciatura</label>
                                <p class="form-control-static">
                                    {{ $empleado->licenciatura ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cédula Licenciatura</label>
                                <p class="form-control-static">
                                    {{ $empleado->cedula_licenciatura ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Maestría</label>
                                <p class="form-control-static">
                                    {{ $empleado->maestria ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Fila 8: Cédula Maestría, Doctorado, Cédula Doctorado --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cédula Maestría</label>
                                <p class="form-control-static">
                                    {{ $empleado->cedula_maestria ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Doctorado</label>
                                <p class="form-control-static">
                                    {{ $empleado->doctorado ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cédula Doctorado</label>
                                <p class="form-control-static">
                                    {{ $empleado->cedula_doctorado ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Fila 9: Estado Civil, Edad Hijos, Tipo Sanguíneo --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado Civil</label>
                                <p class="form-control-static">
                                    {{ $empleado->estado_civil ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edad de Hijos</label>
                                <p class="form-control-static">
                                    {{ $empleado->edad_hijos ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo Sanguíneo</label>
                                <p class="form-control-static">
                                    {{ $empleado->tipo_sanguineo ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Fila 10: Alergias, Restricciones de Salud --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Alergias</label>
                                <p class="form-control-static">
                                    {{ $empleado->alergias ?? 'No especificadas' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Restricciones de Salud</label>
                                <p class="form-control-static">
                                    {{ $empleado->restricciones_salud ?? 'No especificadas' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Fila 11: Contacto Emergencia --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contacto de Emergencia (Nombre)</label>
                                <p class="form-control-static">
                                    {{ $empleado->contacto_emergencia_nombre ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contacto de Emergencia (Teléfono)</label>
                                <p class="form-control-static">
                                    {{ $empleado->contacto_emergencia_telefono ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contacto de Emergencia (Domicilio)</label>
                                <p class="form-control-static">
                                    {{ $empleado->contacto_emergencia_domicilio ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Fila 12: Datos Laborales --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha de Ingreso</label>
                                <p class="form-control-static">
                                    {{ optional($empleado->fecha_ingreso)->format('d/m/Y') ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>¿Desempeña otro trabajo?</label>
                                <p class="form-control-static">
                                    {{ $empleado->desempena_otro_trabajo ? 'Sí' : 'No' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Otra Dependencia</label>
                                <p class="form-control-static">
                                    {{ $empleado->otra_dependencia ?? 'No especificada' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Fila 13: Otro Trabajo (horario y puesto) --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Horario del Otro Trabajo</label>
                                <p class="form-control-static">
                                    {{ $empleado->otro_trabajo_horario ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Puesto en la Otra Dependencia</label>
                                <p class="form-control-static">
                                    {{ $empleado->otro_trabajo_puesto ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Botón de regreso --}}
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Volver al listado
                            </a>
                        </div>
                    </div>

                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-md-10 -->
    </div><!-- row -->
@stop

@section('css')
    <style>
        .form-group label {
            font-weight: bold;
        }
        .form-control-static {
            display: block;
            font-size: 1rem;
            margin-top: 0.5rem;
        }
    </style>
@stop
