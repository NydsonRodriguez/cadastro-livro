<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;

class LivroController extends Controller
{
    protected $livro = '';
    protected $autor = '';
    protected $assunto = '';

    public function __construct()
    {
        $this->livro = new Livro();
        $this->autor = new Autor();
        $this->assunto = new Assunto();
    }

    /**
    *  @OA\Post(
    *      path="/api/livro/create",
    *      summary="Cadastra os dados do Livro",
    *      description="Cadastra os dados do Livro",
    *      tags={"Livro"},
    *      @OA\Parameter(
    *         name="Titulo",
    *         in="query",
    *         description="Insira o título do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Editora",
    *         in="query",
    *         description="Insira a editora do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Edicao",
    *         in="query",
    *         description="Insira a edição do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="AnoPublicacao",
    *         in="query",
    *         description="Insira o ano de publicação do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Autor_CodAu",
    *         in="query",
    *         description="Insira o autor do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Assunto_CodAs",
    *         in="query",
    *         description="Insira o assunto do livro",
    *         required=true,
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function create(Request $request) {
        try {
            $livro = $this->livro->create([
                'Titulo' => $request->input('Titulo'),
                'Editora' => $request->input('Editora'),
                'Edicao' => $request->input('Edicao'),
                'AnoPublicacao' => $request->input('AnoPublicacao')
            ]);

            // Autor
            $livro->autor()->attach($request->input('Autor_CodAu'));
            //$livro->autor()->attach(['Autor_CodAu' => $request->input('Autor_CodAu')]);

            // Assunto
            $livro->assunto()->attach(['Assunto_CodAs' => $request->input('Assunto_CodAs')]);

            return response()->json([
                'status' => 'success',
                'message' => 'Livro cadastrado com sucesso'
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->errorInfo
            ]);
        }
    }

    /**
    *  @OA\Get(
    *      path="/api/livro/read",
    *      summary="Lista de livros",
    *      description="Lista de livros",
    *      tags={"Livro"},
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function read(Request $request) {
        try {
            $livro = $this->livro::with('autor', 'assunto')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Lista de Livros',
                'data' => $livro
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->errorInfo
            ]);
        }
    }

    /**
    *  @OA\Get(
    *      path="/api/livro/edit/{id}",
    *      summary="Retorna dados específicos de um Livro",
    *      description="Retorna dados específicos de um Livro",
    *      tags={"Livro"},
    *      @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="Insira o id do livro",
    *         required=true,
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function edit(Request $request, $id) {
        try {
            $livro = $this->livro::where('Codl', $id)->with('assunto')->get();

            if(!$livro) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nenhum livro encontrado com o id informado'
                ]);
            }

            $autor1 = DB::select('
                SELECT CodAu as Autor_CodAu, Nome, false as "checked"
                  FROM Autor
            ');


            $autor2 = DB::select('
                SELECT la.Autor_CodAu, a.Nome,  true as "checked"
                  FROM Livro_Autor la
            INNER JOIN Autor a ON (la.Autor_CodAu = a.CodAu)
                 WHERE la.Livro_Codl = ' . $id . '
            ');

            $cAutor = collect($autor1)->map(function ($arr) use ($autor2) {

                collect($autor2)->map(function ($arr2) use($arr) {
                    if($arr->Autor_CodAu === $arr2->Autor_CodAu) {
                        $arr->checked = $arr2->checked;
                    }
                });

                return $arr;
            });

            $result = [];

            if(isset($livro->toArray()[0])) {
                $result = array_merge($livro->toArray()[0], ["autor" => $cAutor->toArray()]);
            }

            //dd($result);

            return response()->json([
                'status' => 'success',
                'message' => 'Edição do livro id = ' . $id,
                'data' => $result
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->errorInfo
            ]);
        }
    }

    /**
    *  @OA\Put(
    *      path="/api/livro/update/{id}",
    *      summary="Atualiza dados de um Livro",
    *      description="Atualiza dados de um Livro",
    *      tags={"Livro"},
    *      @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="Insira o id do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Titulo",
    *         in="query",
    *         description="Insira o título do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Editora",
    *         in="query",
    *         description="Insira a editora do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Edicao",
    *         in="query",
    *         description="Insira a edição do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="AnoPublicacao",
    *         in="query",
    *         description="Insira o ano de publicação do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Autor_CodAu",
    *         in="query",
    *         description="Insira o autor do livro",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Assunto_CodAs",
    *         in="query",
    *         description="Insira o assunto do livro",
    *         required=true,
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function update(Request $request, $id) {
        try {
            $livro = $this->livro->find($id);

            if(!$livro) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nenhum livro encontrado com o id informado'
                ]);
            }

            $livro->update($request->all());

            //Autor
            $livro->autor()->detach();
            $livro->autor()->sync($request->input('Autor_CodAu'));
            //$livro->autor()->sync(['Autor_CodAu' => $request->input('Autor_CodAu')]);

            //Assunto
            $livro->assunto()->detach();
            $livro->assunto()->sync(['Assunto_CodAs' => $request->input('Assunto_CodAs')]);

            return response()->json([
                'status' => 'success',
                'message' => 'Livro atualizado com sucesso'
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->errorInfo
            ]);
        }
    }

    /**
    *  @OA\Delete(
    *      path="/api/livro/delete/{id}",
    *      summary="Deleta um Livro específico",
    *      description="Deleta um Livro específico",
    *      tags={"Livro"},
    *      @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="Insira o id do livro",
    *         required=true,
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *  )
    */
    public function delete(Request $request, $id) {
        try {
            $livro = $this->livro->find($id);

            if(!$livro) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nenhum livro encontrado com o id informado'
                ]);
            }

            //Autor
            $livro->autor()->detach();

            //Assunto
            $livro->assunto()->detach();

            $livro->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Livro deletado com sucesso'
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->errorInfo
            ]);
        }
    }
}
