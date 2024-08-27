<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatorioLivrosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE VIEW relatorio_livros
                AS
                SELECT l.*, a.*, ass.*
                  FROM Livro as l
            INNER JOIN Livro_Autor lau ON (l.Codl = lau.Livro_Codl)
            INNER JOIN Autor a ON (lau.Autor_CodAu = a.CodAu)
            INNER JOIN Livro_Assunto las ON (l.Codl = las.Livro_Codl)
            INNER JOIN Assunto ass ON (las.Assunto_CodAs = ass.CodAs);
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
