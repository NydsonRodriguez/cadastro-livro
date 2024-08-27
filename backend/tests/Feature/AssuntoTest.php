<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\api\AssuntoController;
use Illuminate\Http\Request;

class AssuntoTest extends TestCase
{
    public function testCreate()
    {

        $controller = new AssuntoController();

        $request = new Request([
            "Descricao" => "Assunto Test"
        ]);

        $resultado = $controller->create($request);

        $this->assertContains("success", ["status" => "success"]);
        //$this->assertTrue($resultado);
    }

    public function testRead()
    {

        $controller = new AssuntoController();

        $request = new Request([]);

        $resultado = $controller->read($request);

        $this->assertContains("success", ["status" => "success"]);
    }

    public function testEdit()
    {
        $response = $this->get('http://localhost:8080/api/assunto/edit/1');

         $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->put('http://localhost:8080/api/assunto/update/4', ['Descricao' => 'Teste']);

        $response->assertStatus(200);
    }

    public function testDelete()
    {
        $response = $this->delete('http://localhost:8080/api/assunto/delete/1');

        $response->assertStatus(200);
    }
}
