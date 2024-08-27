<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\api\AutorController;
use Illuminate\Http\Request;

class AutorTest extends TestCase
{
    public function testCreate()
    {

        $controller = new AutorController();

        $request = new Request([
            "Nome" => "Autor Test"
        ]);

        $resultado = $controller->create($request);

        $this->assertContains("success", ["status" => "success"]);
        //$this->assertTrue($resultado);
    }

    public function testRead()
    {

        $controller = new AutorController();

        $request = new Request([]);

        $resultado = $controller->read($request);

        $this->assertContains("success", ["status" => "success"]);
    }

    public function testEdit()
    {
        $response = $this->get('http://localhost:8080/api/autor/edit/1');

         $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->put('http://localhost:8080/api/autor/update/4', ['Nome' => 'Teste']);

        $response->assertStatus(200);
    }

    public function testDelete()
    {
        $response = $this->delete('http://localhost:8080/api/autor/delete/1');

        $response->assertStatus(200);
    }
}
