<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaAssunto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Assunto
            - CodAs Integer PK
            - Descricao Varchar(20)
        */
        Schema::create('Assunto', function (Blueprint $table) {
            $table->increments('CodAs');
            $table->string('Descricao', length: 20);
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
        Schema::dropIfExists('Assunto');
    }
}
