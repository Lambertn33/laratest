<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_page_returns_empty_products(): void
    {
        $response = $this->get('/products');

        $response->assertSee('No Products available');

        $response->assertStatus(200);
    }

    public function test_products_page_dont_returns_empty_products(): void
    {
        Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 12000
        ]);

        $response = $this->get('/products');

        $response->assertDontSee('No Products available');

        $response->assertStatus(200);
    }
}
