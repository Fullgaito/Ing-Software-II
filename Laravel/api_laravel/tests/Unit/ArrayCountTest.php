<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ArrayCountTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $array = [1, 2, 3, 4, 5];
        $this->assertCount(5, $array); //verifica que el array tiene 5 elementos
    }
}
