<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class IntTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_verificar_tipo(): void
    {
        $result = 8;
        $this->assertTrue(is_int($result)); //verifica que el resultado es un entero
    }
}
