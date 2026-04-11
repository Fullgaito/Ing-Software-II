<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Cache;
use App\Models\Book;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_paginated_books(){
        Book::factory(20)->create();

        $response = $this->getJson('/api/books');
        //$response->dump();

        $response->assertOk()->assertJsonStructure([
            'data','current_page', 'per_page',
            'total', 'last_page', 'links',
        ])
        ->assertJsonCount(15, 'data'); 
    }

    // public function test_index_caches_the_response(){
    //     Book::factory(5)->create();
    //     $this->getJson('/api/books')->assertOk();
    //     Book::query()->delete();
    //     $response= $this->getJson('/api/books');
    //     $response->assertOk()->assertJsonCount(5, 'data');
    // }
}
