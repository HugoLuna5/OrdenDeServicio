<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_servicios', function (Blueprint $table) {
            $table->id();
            $table->enum('prioridad',['Ordinario', 'Urgente', 'Extraordinario']);
            $table->enum('estado',['Pendiente', 'Atendida'])->default('Pendiente');
            $table->unsignedBigInteger('solicitanteId');
            $table->unsignedBigInteger('departamentoId');
            $table->text('descripcion');
            $table->unsignedBigInteger('recibidoPor')->nullable();
            $table->unsignedBigInteger('atendidoPor')->nullable();
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
        Schema::dropIfExists('orden_servicios');
    }
}
