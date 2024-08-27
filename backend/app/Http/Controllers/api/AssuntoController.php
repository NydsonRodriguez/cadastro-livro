<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Assunto;

class AssuntoController extends Controller
{
    protected $assunto = '';

    public function __construct()
    {
        $this->assunto = new Assunto();
    }

    /**
    *  @OA\Post(
    *      path="/api/assunto/create",
    *      summary="Cadastra o Descricao do Assunto",
    *      description="Cadastra o Descricao do Assunto",
    *      tags={"Assunto"},
    *      @OA\Parameter(
    *         name="Descricao",
    *         in="query",
    *         description="Insira o nome do assunto",
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
            $assunto = $this->assunto->create([
                'Descricao' => $request->input('Descricao')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Assunto cadastrado com sucesso'
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
    *      path="/api/assunto/read",
    *      summary="Lista de assuntos",
    *      description="Lista de assuntos",
    *      tags={"Assunto"},
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
            $assunto = $this->assunto->all();

            return response()->json([
                'status' => 'success',
                'message' => 'Lista de Assuntos',
                'data' => $assunto
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
    *      path="/api/assunto/edit/{id}",
    *      summary="Retorna dados específicos de um Assunto",
    *      description="Retorna dados específicos de um Assunto",
    *      tags={"Assunto"},
    *      @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="Insira o id do assunto",
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
            $assunto = $this->assunto->find($id);

            if(!$assunto) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nenhum assunto encontrado com o id informado'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Edição do assunto id = ' . $id,
                'data' => $assunto
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
    *      path="/api/assunto/update/{id}",
    *      summary="Atualiza dados de um Assunto",
    *      description="Atualiza dados de um Assunto",
    *      tags={"Assunto"},
    *      @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="Insira o id do assunto",
    *         required=true,
    *      ),
    *      @OA\Parameter(
    *         name="Descricao",
    *         in="query",
    *         description="Insira o nome do assunto",
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
            $assunto = $this->assunto->find($id);

            if(!$assunto) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nenhum assunto encontrado com o id informado'
                ]);
            }

            $assunto->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Assunto atualizado com sucesso'
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
    *      path="/api/assunto/delete/{id}",
    *      summary="Deleta um Assunto específico",
    *      description="Deleta um Assunto específico",
    *      tags={"Assunto"},
    *      @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="Insira o id do assunto",
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
            $assunto = $this->assunto->find($id);

            if(!$assunto) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nenhum assunto encontrado com o id informado'
                ]);
            }

            $assunto->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Assunto deletado com sucesso'
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->errorInfo
            ]);
        }
    }
}
