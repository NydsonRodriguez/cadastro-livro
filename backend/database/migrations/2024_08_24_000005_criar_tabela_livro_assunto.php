<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaLivroAssunto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Livro_Assunto
            - Livro_Codl Integer FK
            - Assunto_CodAs Integer FK
        */
        Schema::create('Livro_Assunto', function (Blueprint $table) {
            //$table->increments('CodAsl');

            $table->integer('Livro_Codl')->unsigned();
            $table->integer('Assunto_CodAs')->unsigned();

            $table->foreign('Livro_Codl')->references('Codl')->on('Livro')->onDelete('cascade');
            $table->foreign('Assunto_CodAs')->references('CodAs')->on('Assunto')->onDelete('cascade');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Livro_Assunto');
    }
}
