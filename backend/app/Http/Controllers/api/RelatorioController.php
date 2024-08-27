<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;

class RelatorioController extends Controller
{
    protected $livro = '';
    protected $autor = '';
    protected $assunto = '';

    public function __construct(Livro $livro, Autor $autor, Assunto $assunto)
    {
        $this->livro = $livro;
        $this->autor = $autor;
        $this->assunto = $assunto;
    }

    /**
    *  @OA\Get(
    *      path="/api/relatorio/autor/pdf",
    *      summary="Relatório de autores PDF",
    *      description="Relatório de autores PDF",
    *      tags={"Relatório"},
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function autorPdf(Request $request) {
        $autor = DB::table('Autor')->select('CodAu','Nome')->get()->toArray();

        $data = [
            'title' => 'Relatório de Autores',
            'date' => date('d/m/Y'),
            'autor' => $autor
        ];

        // return view('relatorio/autor-pdf', $data);
        $pdf = PDF::loadView('relatorio/autor-pdf', $data);
        return $pdf->download('relatorio-autor.pdf');
    }

    /**
    *  @OA\Get(
    *      path="/api/relatorio/autor/xls",
    *      summary="Relatório de autores XLS",
    *      description="Relatório de autores XLS",
    *      tags={"Relatório"},
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function autorXls(Request $request) {
        return view('relatorio/autor-xls');
    }
    /**
    *  @OA\Get(
    *      path="/api/relatorio/assunto/pdf",
    *      summary="Relatório de assuntos PDF",
    *      description="Relatório de assuntos PDF",
    *      tags={"Relatório"},
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function assuntoPdf(Request $request) {
        $assunto = DB::table('Assunto')->select('CodAs','Descricao')->get()->toArray();

        $data = [
            'title' => 'Relatório de Assuntos',
            'date' => date('d/m/Y'),
            'assunto' => $assunto
        ];

        // return view('relatorio/assunto-pdf', $data);
        $pdf = PDF::loadView('relatorio/assunto-pdf', $data);
        return $pdf->download('relatorio-assunto.pdf');
    }

    /**
    *  @OA\Get(
    *      path="/api/relatorio/assunto/xls",
    *      summary="Relatório de assuntos XLS",
    *      description="Relatório de assuntos XLS",
    *      tags={"Relatório"},
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function assuntoXls(Request $request) {
        return view('relatorio/assunto-xls');
    }
    /**
    *  @OA\Get(
    *      path="/api/relatorio/livro/pdf",
    *      summary="Relatório de livros PDF",
    *      description="Relatório de livros PDF",
    *      tags={"Relatório"},
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function livroPdf(Request $request) {
        $livro = \App\Models\Livro::with('autor', 'assunto')->get()->toArray();

        $data = [
            'title' => 'Relatório de Livros',
            'date' => date('d/m/Y'),
            'livro' => $livro
        ];

        // return view('relatorio/livro-pdf', $data);
        $pdf = PDF::loadView('relatorio/livro-pdf', $data);
        return $pdf->download('relatorio-livro.pdf');
    }

    /**
    *  @OA\Get(
    *      path="/api/relatorio/livro/xls",
    *      summary="Relatório de livros XLS",
    *      description="Relatório de livros XLS",
    *      tags={"Relatório"},
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function livroXls(Request $request) {
        return view('relatorio/livro-xls');
    }
}
