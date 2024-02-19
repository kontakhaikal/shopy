<?php

namespace Tests\Feature;

use App\Dto\RegisterCustomerRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterCustomerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_register_customer(): void
    {
        $body = new RegisterCustomerRequest(
            'customer',
            'Customer#123'
        );
        $response = $this->post('/register', $body->all());

        $response->assertRedirectToRoute('login');

        $this->assertDatabaseHas('users', [
            'username' => $body->username,
            'role' => 'customer'
        ]);
    }
}
