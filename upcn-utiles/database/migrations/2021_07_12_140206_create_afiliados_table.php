<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfiliadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afiliados', function (Blueprint $table) {
            $table->id('idAfiliado');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('localidad');
            $table->integer('cantidadHijos');
            $table->enum('tipoEmpleado', ['publico', 'municipal']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('afiliados');
    }
}
