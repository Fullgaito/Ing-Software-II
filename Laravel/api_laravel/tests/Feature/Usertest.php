<?php

namespace Tests\Feature;    

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Usertest extends TestCase
{
    use RefreshDatabase;
    public function test_users(): void
    {
       
        $response = $this->post('/api/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'pregunta' => '¿Cuál es tu color favorito?',
            'respuesta' => 'Azul',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users',['email' => 'john@example.com']);
    }
}
