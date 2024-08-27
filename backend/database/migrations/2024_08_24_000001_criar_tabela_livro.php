<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaLivro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Livro
            - Codl Integer PK
            - Titulo Varchar(40)
            - Editora Varchar(40)
            - Edicao Integer
            - AnoPublicacao Varchar(4)
        */
        //
        Schema::create('Livro', function (Blueprint $table) {
            $table->increments('Codl');
            $table->string('Titulo', length: 40);
            $table->string('Editora', length: 40);
            $table->integer('Edicao')->unsigned();
            $table->string('AnoPublicacao', length: 4);
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
        Schema::dropIfExists('Livro');
    }
}
