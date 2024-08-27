<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaLivroAutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Livro_Autor
            - Livro_Codl Integer FK
            - Autor_CodAu Integer FK
        */
        Schema::create('Livro_Autor', function (Blueprint $table) {
            //$table->increments('CodAul');

            $table->integer('Livro_Codl')->unsigned();
            $table->integer('Autor_CodAu')->unsigned();

            $table->foreign('Livro_Codl')->references('Codl')->on('Livro')->onDelete('cascade');
            $table->foreign('Autor_CodAu')->references('CodAu')->on('Autor')->onDelete('cascade');

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
        Schema::dropIfExists('Livro_Autor');
    }
}
