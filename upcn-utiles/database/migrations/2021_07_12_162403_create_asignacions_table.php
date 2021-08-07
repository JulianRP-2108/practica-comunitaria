<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id('idAsignacion');

            $table->unsignedBigInteger('fkIdAfiliado');
            $table  ->foreign('fkIdAfiliado')
                    ->references('idAfiliado')
                    ->on('afiliados')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->unsignedBigInteger('fkIdKit');
            $table  ->foreign('fkIdKit')
                    ->references('idKit')
                    ->on('kits')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->unsignedBigInteger('fkIdUsuario');
            $table  ->foreign('fkIdUsuario')
                    ->references('idUsuario')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->unsignedBigInteger('cantidad');

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
        Schema::dropIfExists('asignaciones');
    }
}
