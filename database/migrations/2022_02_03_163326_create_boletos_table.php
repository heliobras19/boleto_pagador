<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_pagador');
            $table->string('data_vencimento');
            $table->integer('valor_boleto');
            $table->string('instrucao_1')->nullable();
            $table->string('instrucao_2')->nullable();
            $table->string('instrucao_3')->nullable();
            $table->text('descricao');
            $table->string('tipo_multa')->nullable();
            $table->integer('valor_multa');
            $table->string('tipo_juros')->nullable();
            $table->integer('valor_juros');
            $table->string('tipo_desconto')->nullable();
            $table->integer('valor_desconto');
            $table->string('data_limite_desconto');
            $table->string('referencia')->nullable();
            $table->timestamps();
           // $table->foreign('id_pagador')->references('id')->on('pagadors')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boletos');
    }
}
