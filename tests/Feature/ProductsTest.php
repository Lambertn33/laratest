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

    public function test_admin_can_see_product_create_button(): void
    {
        $response = $this->actingAs($this->admin)->get('/products');

        $response->assertSee('Create New Product');
    }

    public function test_product_create_page_renders_successfully_to_admin(): void
    {
        $response = $this->actingAs($this->admin)->get('/products/create');

        $response->assertStatus(200);
    }

    public function test_users_cannot_see_product_create_button(): void
    {
        $response = $this->actingAs($this->user)->get('/products');

        $response->assertDontSee('Create New Product');
    }

    public function test_product_create_page_shouldnt_render_to_user(): void
    {
        $response = $this->actingAs($this->user)->get('/products/create');

        $response->assertStatus(403);
    }

    public function test_product_created_successfully(): void
    {
        $newProduct = [
            'name' => 'New Product',
            'price' => 'Product price',
            'description' => 'product description'
        ];
        $response  = $this->actingAs($this->admin)->post('/products', $newProduct);
        $response->assertStatus(302);

        $this->assertDatabaseHas('products', $newProduct);
    }
}
