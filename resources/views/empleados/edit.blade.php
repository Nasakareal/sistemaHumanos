@extends('adminlte::page')

@section('title', 'Editar Empleado')

@section('content_header')
    <h1>Edición de Empleado</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Modifique los Datos del Empleado</h3>
                </div>
                <div class="card-body">
                    <!-- Formulario Principal para Empleado -->
                    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- DATOS PERSONALES Y DE CONTACTO -->
                        <div class="row">
                            <!-- Nombre -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" name="nombre" id="nombre"
                                           class="form-control @error('nombre') is-invalid @enderror"
                                           value="{{ old('nombre', $empleado->nombre) }}"
                                           placeholder="Nombre completo" required>
                                    @error('nombre')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Puesto -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="puesto">Puesto <span class="text-danger">*</span></label>
                                    <input type="text" name="puesto" id="puesto"
                                           class="form-control @error('puesto') is-invalid @enderror"
                                           value="{{ old('puesto', $empleado->puesto) }}"
                                           placeholder="Puesto laboral" required>
                                    @error('puesto')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Área de Adscripción -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="area_adscripcion">Área de Adscripción</label>
                                    <input type="text" name="area_adscripcion" id="area_adscripcion"
                                           class="form-control @error('area_adscripcion') is-invalid @enderror"
                                           value="{{ old('area_adscripcion', $empleado->area_adscripcion) }}"
                                           placeholder="Área adscrita">
                                    @error('area_adscripcion')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Fecha de Nacimiento -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                           class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                           value="{{ old('fecha_nacimiento', $empleado->fecha_nacimiento ? $empleado->fecha_nacimiento->format('Y-m-d') : '') }}">
                                    @error('fecha_nacimiento')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Lugar de Nacimiento -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lugar_nacimiento">Lugar de Nacimiento</label>
                                    <input type="text" name="lugar_nacimiento" id="lugar_nacimiento"
                                           class="form-control @error('lugar_nacimiento') is-invalid @enderror"
                                           value="{{ old('lugar_nacimiento', $empleado->lugar_nacimiento) }}"
                                           placeholder="Ciudad, Estado">
                                    @error('lugar_nacimiento')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- NSS -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nss">NSS</label>
                                    <input type="text" name="nss" id="nss"
                                           class="form-control @error('nss') is-invalid @enderror"
                                           value="{{ old('nss', $empleado->nss) }}"
                                           placeholder="Número de Seguro Social">
                                    @error('nss')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="correo_electronico">Correo Electrónico <span class="text-danger">*</span></label>
                                    <input type="email" name="correo_electronico" id="correo_electronico"
                                           class="form-control @error('correo_electronico') is-invalid @enderror"
                                           value="{{ old('correo_electronico', $empleado->correo_electronico) }}"
                                           placeholder="ejemplo@dominio.com" required>
                                    @error('correo_electronico')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- RFC -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rfc">RFC</label>
                                    <input type="text" name="rfc" id="rfc"
                                           class="form-control @error('rfc') is-invalid @enderror"
                                           value="{{ old('rfc', $empleado->rfc) }}"
                                           placeholder="RFC del empleado">
                                    @error('rfc')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- CURP -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="curp">CURP</label>
                                    <input type="text" name="curp" id="curp"
                                           class="form-control @error('curp') is-invalid @enderror"
                                           value="{{ old('curp', $empleado->curp) }}"
                                           placeholder="CURP del empleado">
                                    @error('curp')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- DOMICILIO -->
                        <h5>Datos de Domicilio</h5>
                        <div class="row">
                            <!-- Domicilio -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="domicilio">Domicilio</label>
                                    <input type="text" name="domicilio" id="domicilio"
                                           class="form-control @error('domicilio') is-invalid @enderror"
                                           value="{{ old('domicilio', $empleado->domicilio) }}"
                                           placeholder="Ej. Calle X #111, Col. Centro">
                                    @error('domicilio')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Calle -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="calle">Calle</label>
                                    <input type="text" name="calle" id="calle"
                                           class="form-control @error('calle') is-invalid @enderror"
                                           value="{{ old('calle', $empleado->calle) }}"
                                           placeholder="Nombre de la calle">
                                    @error('calle')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Colonia -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="colonia">Colonia</label>
                                    <input type="text" name="colonia" id="colonia"
                                           class="form-control @error('colonia') is-invalid @enderror"
                                           value="{{ old('colonia', $empleado->colonia) }}"
                                           placeholder="Colonia o barrio">
                                    @error('colonia')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- No Ext -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="no_ext">No. Ext</label>
                                    <input type="text" name="no_ext" id="no_ext"
                                           class="form-control @error('no_ext') is-invalid @enderror"
                                           value="{{ old('no_ext', $empleado->no_ext) }}"
                                           placeholder="Núm. Exterior">
                                    @error('no_ext')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- No Int -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="no_int">No. Int</label>
                                    <input type="text" name="no_int" id="no_int"
                                           class="form-control @error('no_int') is-invalid @enderror"
                                           value="{{ old('no_int', $empleado->no_int) }}"
                                           placeholder="Núm. Interior">
                                    @error('no_int')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- CP -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="cp">Código Postal</label>
                                    <input type="text" name="cp" id="cp"
                                           class="form-control @error('cp') is-invalid @enderror"
                                           value="{{ old('cp', $empleado->cp) }}"
                                           placeholder="C.P.">
                                    @error('cp')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Población -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="poblacion">Población</label>
                                    <input type="text" name="poblacion" id="poblacion"
                                           class="form-control @error('poblacion') is-invalid @enderror"
                                           value="{{ old('poblacion', $empleado->poblacion) }}"
                                           placeholder="Ciudad o municipio">
                                    @error('poblacion')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- TELÉFONOS -->
                        <div class="row">
                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" name="telefono" id="telefono"
                                           class="form-control @error('telefono') is-invalid @enderror"
                                           value="{{ old('telefono', $empleado->telefono) }}"
                                           placeholder="Ej. (000) 000-0000">
                                    @error('telefono')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Celular -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input type="text" name="celular" id="celular"
                                           class="form-control @error('celular') is-invalid @enderror"
                                           value="{{ old('celular', $empleado->celular) }}"
                                           placeholder="Ej. (000) 000-0000">
                                    @error('celular')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- FORMACIÓN ACADÉMICA -->
                        <h5>Formación Académica</h5>
                        <div class="row">
                            <!-- Licenciatura -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="licenciatura">Licenciatura</label>
                                    <input type="text" name="licenciatura" id="licenciatura"
                                           class="form-control @error('licenciatura') is-invalid @enderror"
                                           value="{{ old('licenciatura', $empleado->licenciatura) }}"
                                           placeholder="Ej. Ingeniería en Sistemas">
                                    @error('licenciatura')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Cédula Licenciatura -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cedula_licenciatura">Cédula Licenciatura</label>
                                    <input type="text" name="cedula_licenciatura" id="cedula_licenciatura"
                                           class="form-control @error('cedula_licenciatura') is-invalid @enderror"
                                           value="{{ old('cedula_licenciatura', $empleado->cedula_licenciatura) }}">
                                    @error('cedula_licenciatura')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Maestría -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maestria">Maestría</label>
                                    <input type="text" name="maestria" id="maestria"
                                           class="form-control @error('maestria') is-invalid @enderror"
                                           value="{{ old('maestria', $empleado->maestria) }}">
                                    @error('maestria')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Cédula Maestría -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cedula_maestria">Cédula Maestría</label>
                                    <input type="text" name="cedula_maestria" id="cedula_maestria"
                                           class="form-control @error('cedula_maestria') is-invalid @enderror"
                                           value="{{ old('cedula_maestria', $empleado->cedula_maestria) }}">
                                    @error('cedula_maestria')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Doctorado -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="doctorado">Doctorado</label>
                                    <input type="text" name="doctorado" id="doctorado"
                                           class="form-control @error('doctorado') is-invalid @enderror"
                                           value="{{ old('doctorado', $empleado->doctorado) }}">
                                    @error('doctorado')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Cédula Doctorado -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cedula_doctorado">Cédula Doctorado</label>
                                    <input type="text" name="cedula_doctorado" id="cedula_doctorado"
                                           class="form-control @error('cedula_doctorado') is-invalid @enderror"
                                           value="{{ old('cedula_doctorado', $empleado->cedula_doctorado) }}">
                                    @error('cedula_doctorado')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- DATOS FAMILIARES Y DE SALUD -->
                        <h5>Datos Familiares y de Salud</h5>
                        <div class="row">
                            <!-- Estado Civil -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="estado_civil">Estado Civil</label>
                                    <input type="text" name="estado_civil" id="estado_civil"
                                           class="form-control @error('estado_civil') is-invalid @enderror"
                                           value="{{ old('estado_civil', $empleado->estado_civil) }}">
                                    @error('estado_civil')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Edad Hijos -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="edad_hijos">Edad de Hijos</label>
                                    <input type="number" name="edad_hijos" id="edad_hijos"
                                           class="form-control @error('edad_hijos') is-invalid @enderror"
                                           value="{{ old('edad_hijos', $empleado->edad_hijos) }}" placeholder="Ej. 10">
                                    @error('edad_hijos')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tipo Sanguíneo -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tipo_sanguineo">Tipo Sanguíneo</label>
                                    <input type="text" name="tipo_sanguineo" id="tipo_sanguineo"
                                           class="form-control @error('tipo_sanguineo') is-invalid @enderror"
                                           value="{{ old('tipo_sanguineo', $empleado->tipo_sanguineo) }}" placeholder="Ej. O+, A-">
                                    @error('tipo_sanguineo')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Alergias -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="alergias">Alergias</label>
                                    <input type="text" name="alergias" id="alergias"
                                           class="form-control @error('alergias') is-invalid @enderror"
                                           value="{{ old('alergias', $empleado->alergias) }}" placeholder="Ej. Penicilina, polen...">
                                    @error('alergias')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Restricciones de Salud -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="restricciones_salud">Restricciones de Salud</label>
                                    <textarea name="restricciones_salud" id="restricciones_salud"
                                              class="form-control @error('restricciones_salud') is-invalid @enderror"
                                              rows="2"
                                              placeholder="Describa si el empleado tiene alguna restricción">{{ old('restricciones_salud', $empleado->restricciones_salud) }}</textarea>
                                    @error('restricciones_salud')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- CONTACTO DE EMERGENCIA -->
                        <h5>Contacto de Emergencia</h5>
                        <div class="row">
                            <!-- Nombre -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contacto_emergencia_nombre">Nombre</label>
                                    <input type="text" name="contacto_emergencia_nombre" id="contacto_emergencia_nombre"
                                           class="form-control @error('contacto_emergencia_nombre') is-invalid @enderror"
                                           value="{{ old('contacto_emergencia_nombre', $empleado->contacto_emergencia_nombre) }}"
                                           placeholder="Nombre de contacto">
                                    @error('contacto_emergencia_nombre')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contacto_emergencia_telefono">Teléfono</label>
                                    <input type="text" name="contacto_emergencia_telefono" id="contacto_emergencia_telefono"
                                           class="form-control @error('contacto_emergencia_telefono') is-invalid @enderror"
                                           value="{{ old('contacto_emergencia_telefono', $empleado->contacto_emergencia_telefono) }}"
                                           placeholder="Ej. (000) 000-0000">
                                    @error('contacto_emergencia_telefono')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Domicilio -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contacto_emergencia_domicilio">Domicilio</label>
                                    <input type="text" name="contacto_emergencia_domicilio" id="contacto_emergencia_domicilio"
                                           class="form-control @error('contacto_emergencia_domicilio') is-invalid @enderror"
                                           value="{{ old('contacto_emergencia_domicilio', $empleado->contacto_emergencia_domicilio) }}"
                                           placeholder="Domicilio del contacto">
                                    @error('contacto_emergencia_domicilio')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- DATOS LABORALES -->
                        <h5>Datos Laborales</h5>
                        <div class="row">
                            <!-- Fecha Ingreso -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                                    <input type="date" name="fecha_ingreso" id="fecha_ingreso"
                                           class="form-control @error('fecha_ingreso') is-invalid @enderror"
                                           value="{{ old('fecha_ingreso', $empleado->fecha_ingreso ? $empleado->fecha_ingreso->format('Y-m-d') : '') }}">
                                    @error('fecha_ingreso')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- ¿Desempeña otro trabajo? -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="desempena_otro_trabajo">¿Desempeña otro trabajo?</label>
                                    <select name="desempena_otro_trabajo" id="desempena_otro_trabajo"
                                            class="form-control @error('desempena_otro_trabajo') is-invalid @enderror">
                                        <option value="0" {{ old('desempena_otro_trabajo', $empleado->desempena_otro_trabajo) == false ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('desempena_otro_trabajo', $empleado->desempena_otro_trabajo) == true ? 'selected' : '' }}>Sí</option>
                                    </select>
                                    @error('desempena_otro_trabajo')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Otra Dependencia -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="otra_dependencia">Otra Dependencia</label>
                                    <input type="text" name="otra_dependencia" id="otra_dependencia"
                                           class="form-control @error('otra_dependencia') is-invalid @enderror"
                                           value="{{ old('otra_dependencia', $empleado->otra_dependencia) }}"
                                           placeholder="Nombre de la otra dependencia">
                                    @error('otra_dependencia')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Otro Trabajo Horario -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="otro_trabajo_horario">Horario</label>
                                    <input type="text" name="otro_trabajo_horario" id="otro_trabajo_horario"
                                           class="form-control @error('otro_trabajo_horario') is-invalid @enderror"
                                           value="{{ old('otro_trabajo_horario', $empleado->otro_trabajo_horario) }}"
                                           placeholder="Ej. L-V 7:00 a 15:00">
                                    @error('otro_trabajo_horario')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Otro Trabajo Puesto -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="otro_trabajo_puesto">Puesto en la Otra Dependencia</label>
                                    <input type="text" name="otro_trabajo_puesto" id="otro_trabajo_puesto"
                                           class="form-control @error('otro_trabajo_puesto') is-invalid @enderror"
                                           value="{{ old('otro_trabajo_puesto', $empleado->otro_trabajo_puesto) }}"
                                           placeholder="Puesto que desempeña">
                                    @error('otro_trabajo_puesto')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Botones del Formulario -->
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-check"></i> Actualizar
                                </button>
                                <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                                    <i class="fa-solid fa-ban"></i> Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                    <!-- Fin del Formulario Principal -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .form-group label {
            font-weight: bold;
        }
    </style>
@stop

@section('js')
    <script>
        @if (session('success'))
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Error en el formulario',
                html: `
                    <ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonText: 'Aceptar'
            });
        @endif
    </script>
@stop
