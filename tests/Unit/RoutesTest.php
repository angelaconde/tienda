<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    /**
     * Test to check routes work.
     *
     * @return void
     */
    public function testRoutes()
    {
        $routes = ['/', '/producto', '/categoria', '/ruta_falsa_que_da_error'];
        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }
    /**
     * Test to check empty category gives 404 error message.
     * 
     * @return void
     */
    public function testEmptyCategory()
    {
        $response = $this->get('/categoria');
        $response->assertStatus(404);
        $response->assertSee('La página que ha solicitado no existe.');
    }
}
