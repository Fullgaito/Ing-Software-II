<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductStoreTest extends TestCase
{
    use RefreshDatabase;
    public function test_products(): void
    {
        $response = $this->post('/api/products', [
            'name' => 'Producto de prueba',
            'price' => 19.99,
            'stock' => 100,
        ]);

        $response->assertCreated();
    }
}
