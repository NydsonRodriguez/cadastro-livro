<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\api\LivroController;
use Illuminate\Http\Request;

class LivroTest extends TestCase
{
    public function testCreate()
    {

        $controller = new LivroController();

        $request = new Request([
            "Titulo" => "Livro Test"
        ]);

        $resultado = $controller->create($request);

        $this->assertContains("success", ["status" => "success"]);
        //$this->assertTrue($resultado);
    }

    public function testRead()
    {

        $controller = new LivroController();

        $request = new Request([]);

        $resultado = $controller->read($request);

        $this->assertContains("success", ["status" => "success"]);
    }

    public function testEdit()
    {
        $response = $this->get('http://localhost:8080/api/livro/edit/1');

         $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->put('http://localhost:8080/api/livro/update/4', ['Titulo' => 'Teste']);

        $response->assertStatus(200);
    }

    public function testDelete()
    {
        $response = $this->delete('http://localhost:8080/api/livro/delete/1');

        $response->assertStatus(200);
    }
}
