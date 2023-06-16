<?php

namespace Tests\Unit;

use App;
use PHPUnit\Framework\TestCase;

class InjectAfterTEst extends TestCase
{
    /** @test*/
    public function it_inserts_to_array(): void 
    {
        $array = ["foo" => 3, "bar" => 1, "bob" => 5, "gog" => 6];
        $res = injectAfter($array, "bbb", "aaa", 7);
        $excepted = 5;
        $this->assertEquals($excepted, count($res));
    }

    /** @test*/
    public function it_inserts_end_of_array(): void 
    {
        $array = ["foo" => 3, "bar" => 1, "bob" => 5, "gog" => 6];
        $res = injectAfter($array, "bbb", "aaa", 7);

        $lastElement = end($res);
        $lastElemetKey = key($res);
        $excepted = ["aaa" => 7];
        $expectedElement = end($excepted);
        $expectedElementKey = key($excepted);
        // assert values
        $this->assertEquals($lastElement, $expectedElement);
        //assert keys
        $this->assertEquals($lastElemetKey, $expectedElementKey);
    }

    /** @test*/
    public function it_inserts_end_of_array_and_rest_of_array_stays_same(): void 
    {
        $array = ["foo" => 3, "bar" => 1, "bob" => 5, "gog" => 6];
        $res = injectAfter($array, "bbb", "aaa", 7);

        $expected = ["foo" => 3, "bar" => 1, "bob" => 5, "gog" => 6];
        

        $this->assertEquals($expected, array_slice($res, 0, count($expected )));
    }


    /** @test*/
    public function it_inserts_at_random_index_of_array(): void 
    {
        $array = ["foo" => 3, "bar" => 1, "bob" => 5, "gog" => 6];
        $randElement = array_rand($array);

        $res = injectAfter($array, $randElement, "aaa", 7);
        $indexOfInserted = array_search($randElement, array_keys($res));
        
        // assert key
        $this->assertEquals(array_keys($res)[$indexOfInserted + 1], "aaa");
        // assert value
        $this->assertEquals(array_values($res)[$indexOfInserted + 1], 7);
    }
}