<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaAutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Autor
            - CodAu Integer PK
            - Nome Varchar(40)
        */
        Schema::create('Autor', function (Blueprint $table) {
            $table->increments('CodAu');
            $table->string('Nome', length: 40);
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
        Schema::dropIfExists('Autor');
    }
}
