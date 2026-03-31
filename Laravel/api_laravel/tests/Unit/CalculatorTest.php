<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    
    public function test_it_adds_two_numbers(): void
    {
        $result= 5 + 3;
        $this->assertEquals(8, $result); //verifica que el resultado es igual a 8
        
    }
}
