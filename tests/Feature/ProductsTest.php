<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->admin = User::factory()->create([
            'is_admin' => true
        ]);
    }

    public function test_products_page_returns_empty_products(): void
    {
        $response = $this->actingAs($this->user)->get('/products');
        $response->assertSee('No Products available');
    }

    public function test_products_page_returns_correct_title(): void
    {
        $response = $this->actingAs($this->user)->get('/products');
        $response->assertSee('Products List');
    }

    public function test_should_return_paginated_products(): void
    {
        $products = Product::factory(12)->create();

        $lastProduct = $products->last();

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertViewHas('products', function ($collection) use ($lastProduct) {
            return !$collection->contains($lastProduct);
        });
    }

    public function test_products_page_dont_returns_empty_products(): void
    {
        Product::factory(12)->create();

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertDontSee('No Products available');
    }
}
