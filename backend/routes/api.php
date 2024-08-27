<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\LivroController;
use App\Http\Controllers\api\AutorController;
use App\Http\Controllers\api\AssuntoController;
use App\Http\Controllers\api\RelatorioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Home Controller
Route::post('home', [HomeController::class, 'index']);

// Livro Controller
// Route::get('/add', [LivroController::class, 'add']);
Route::post('livro/create', [LivroController::class, 'create']);
Route::get('livro/read', [LivroController::class, 'read']);
Route::get('livro/edit/{id}', [LivroController::class, 'edit']);
Route::put('livro/update/{id}', [LivroController::class, 'update']);
Route::delete('livro/delete/{id}', [LivroController::class, 'delete']);

// Autor Controller
// Route::get('/add', [AutorController::class, 'add']);
Route::post('autor/create', [AutorController::class, 'create']);
Route::get('autor/read', [AutorController::class, 'read']);
Route::get('autor/edit/{id}', [AutorController::class, 'edit']);
Route::put('autor/update/{id}', [AutorController::class, 'update']);
Route::delete('autor/delete/{id}', [AutorController::class, 'delete']);

// Assunto Controller
// Route::get('/add', [AssuntoController::class, 'add']);
Route::post('assunto/create', [AssuntoController::class, 'create']);
Route::get('assunto/read', [AssuntoController::class, 'read']);
Route::get('assunto/edit/{id}', [AssuntoController::class, 'edit']);
Route::put('assunto/update/{id}', [AssuntoController::class, 'update']);
Route::delete('assunto/delete/{id}', [AssuntoController::class, 'delete']);

// Relatório Controller
Route::get('relatorio/autor/pdf', [RelatorioController::class, 'autorPdf']);
Route::get('relatorio/autor/xls', [RelatorioController::class, 'autorXls']);
Route::get('relatorio/assunto/pdf', [RelatorioController::class, 'assuntoPdf']);
Route::get('relatorio/assunto/xls', [RelatorioController::class, 'assuntoXls']);
Route::get('relatorio/livro/pdf', [RelatorioController::class, 'livroPdf']);
Route::get('relatorio/livro/xls', [RelatorioController::class, 'livroXls']);
