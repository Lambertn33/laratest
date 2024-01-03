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
    }

    public function test_products_page_returns_correct_title(): void
    {
        $response = $this->get('/products');

        $response->assertSee('Products List');
    }

    public function test_should_return_paginated_products(): void
    {
        $products = Product::factory(20)->create();

        $lastProduct = $products->last();

        $response = $this->get('/products');

        $response->assertViewHas('products', function($collection) use($lastProduct) {
            return !$collection->contains($lastProduct);
        });
    }

    public function test_products_page_dont_returns_empty_products(): void
    {
        $product = Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 12000
        ]);

        $response = $this->get('/products');

        $response->assertDontSee('No Products available');

        $response->assertViewHas('products', function($collection) use ($product) {
            return $collection->contains($product);
        });
    }
}
