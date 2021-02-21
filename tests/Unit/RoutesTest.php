<?php

namespace Tests\Unit;

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
    public function testRouteMain()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test to check routes work.
     *
     * @return void
     */
    public function testRouteProduct()
    {
        $response = $this->get('/product');
        $response->assertStatus(200);
    }

    /**
     * Test to check routes work.
     *
     * @return void
     */
    public function testRouteAllProducts()
    {
        $response = $this->get('/todo');
        $response->assertStatus(200);
    }

    /**
     * Test to check routes work.
     *
     * @return void
     */
    public function testRouteCategoryFrescos()
    {
        $response = $this->get('/categoria/1');
        $response->assertStatus(200);
    }

    /**
     * Test to check routes work.
     *
     * @return void
     */
    public function testRouteLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * Test to check routes work.
     *
     * @return void
     */
    public function testRouteRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**
     * Test to check routes work.
     *
     * @return void
     */
    public function testRouteCartCheckout()
    {
        $response = $this->get('cart-checkout');
        $response->assertStatus(200);
    }

    /**
     * Test to check routes work.
     *
     * @return void
     */
    public function testRouteOrder()
    {
        $response = $this->get('order');
        $response->assertStatus(200);
    }

    /**
     * Test to check routes work.
     *
     * @return void
     */
    public function testRoutePayment()
    {
        $response = $this->get('payment');
        $response->assertStatus(200);
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
