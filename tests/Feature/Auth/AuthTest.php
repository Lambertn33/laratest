<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_login(): void
    {
        User::create([
            'name' => 'lamb',
            'email' => 'lamb@gmail.com',
            'password' => Hash::make('lamb12345')
        ]);

        $response = $this->post('/login', [
            'email' => 'lamb@gmail.com',
            'password' => 'lamb12345'
        ]);

        $response->assertRedirectToRoute('products.index');
    }

    public function test_user_cannot_access_private_page_without_login(): void
    {
        $response = $this->get('/products');

        $response->assertRedirect('/login');
    }
}
