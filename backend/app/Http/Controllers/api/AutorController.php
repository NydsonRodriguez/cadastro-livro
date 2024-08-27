<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redis;
use App\Models\Autor;

class AutorController extends Controller
{
    protected $autor = '';

    public function __construct()
    {
        $this->autor = new Autor();
    }

    /**
    *  @OA\Post(
    *      path="/api/autor/create",
    *      summary="Cadastra o Nome do Autor",
    *      description="Cadastra o Nome do Autor",
    *      tags={"Autor"},
    *      @OA\Parameter(
    *         name="Nome",
    *         in="query",
    *         description="Insira o nome do autor",
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
            $autor = $this->autor->create([
                'Nome' => $request->input('Nome')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Autor cadastrado com sucesso'
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
    *      path="/api/autor/read",
    *      summary="Lista de autores",
    *      description="Lista de autores",
    *      tags={"Autor"},
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
            $autor = $this->autor->all();

            return response()->json([
                'status' => 'success',
                'message' => 'Lista de Autores',
                'data' => $autor
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
    *      path="/api/autor/edit/{id}",
    *      summary="Retorna dados específicos de um Autor",
    *      description="Retorna dados específicos de um Autor",
    *      tags={"Autor"},
    *      @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="Insira o id do autor",
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
            $autor = $this->autor->find($id);

            if(!$autor) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nenhum autor encontrado com o id informado'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Edição do autor id = ' . $id,
                'data' => $autor
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
    *      path="/api/autor/update/{id}",
    *      summary="Atualiza dados de um Autor",
    *      description="Atualiza dados de um Autor",
    *      tags={"Autor"},
    *      @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="Insira o id do autor",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Nome",
    *         in="query",
    *         description="Insira o nome do autor",
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
            $autor = $this->autor->find($id);

            if(!$autor) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nenhum autor encontrado com o id informado'
                ]);
            }

            $autor->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Autor atualizado com sucesso'
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
    *      path="/api/autor/delete/{id}",
    *      summary="Deleta um Autor específico",
    *      description="Deleta um Autor específico",
    *      tags={"Autor"},
    *      @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="Insira o id do autor",
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
            $autor = $this->autor->find($id);

            if(!$autor) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nenhum autor encontrado com o id informado'
                ]);
            }

            $autor->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Autor deletado com sucesso'
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->errorInfo
            ]);
        }
    }
}
