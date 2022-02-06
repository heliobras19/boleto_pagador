<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class   CreatePagadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagadors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->string('nome');
            $table->string('documento');
            $table->string('celular', 10);
            $table->string('email');
            $table->string('data_de_nascimento');
            $table->string('cep', 11);
            $table->string('rua');
            $table->string('bairro');
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cidade');
            $table->string('estado');
            $table->timestamps();
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
        Schema::dropIfExists('pagadors');
    }
}
