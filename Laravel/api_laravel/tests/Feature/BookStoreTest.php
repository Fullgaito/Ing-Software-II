<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Cache;
use App\Models\Book;

class BookStoreTest extends TestCase
{
    public function store_creates_a_book_successfully()
    {
        $payload = [
            'title' => 'Don Quijote',
            'author' => 'Miguel de Cervantes',
            'year' => 1605,
            'genre'=> 'Novela',
        ];

        $response = $this->postJson('/api/books', $payload);

        $this->postJson('/api/books', $payload)
                ->assertCreated()
                ->assertJsonFragment([
                     'title' => 'Don Quijote',
                 ]);

        $this->assertDatabaseHas('books', [
            'title' => 'Don Quijote',
            'author' => 'Miguel de Cervantes',
            'year' => 1605,
            'genre' => 'Novela',
        ]);
    }
}
