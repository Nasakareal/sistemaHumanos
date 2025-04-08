<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();

            // Datos personales y de contacto
            $table->string('nombre');
            $table->string('puesto');
            $table->string('area_adscripcion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('lugar_nacimiento')->nullable();
            $table->string('nss')->nullable();
            $table->string('correo_electronico')->unique();
            $table->string('rfc')->nullable();
            $table->string('curp')->nullable();

            // Domicilio
            $table->string('domicilio')->nullable();
            $table->string('calle')->nullable();
            $table->string('no_ext')->nullable();
            $table->string('no_int')->nullable();
            $table->string('colonia')->nullable();
            $table->string('cp', 10)->nullable();
            $table->string('poblacion')->nullable();

            // Teléfonos
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();

            // Formación académica
            $table->string('licenciatura')->nullable();
            $table->string('cedula_licenciatura')->nullable();
            $table->string('maestria')->nullable();
            $table->string('cedula_maestria')->nullable();
            $table->string('doctorado')->nullable();
            $table->string('cedula_doctorado')->nullable();

            // Datos familiares y de salud
            $table->string('estado_civil')->nullable();
            $table->unsignedInteger('edad_hijos')->nullable();
            $table->text('alergias')->nullable();
            $table->string('tipo_sanguineo', 5)->nullable();
            $table->text('restricciones_salud')->nullable();

            // Contacto de emergencia
            $table->string('contacto_emergencia_nombre')->nullable();
            $table->string('contacto_emergencia_telefono')->nullable();
            $table->string('contacto_emergencia_domicilio')->nullable();

            // Datos laborales
            $table->date('fecha_ingreso')->nullable();
            $table->boolean('desempena_otro_trabajo')->default(false);
            $table->string('otra_dependencia')->nullable();
            $table->string('otro_trabajo_horario')->nullable();
            $table->string('otro_trabajo_puesto')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
