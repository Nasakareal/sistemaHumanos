<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('empleado_id')->constrained('empleados')->onDelete('cascade');
            $table->string('tipo');
            $table->date('fecha_entrega')->nullable();
            $table->string('observaciones')->nullable();
            $table->boolean('vigente')->default(true);
            $table->string('ruta_archivo')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
