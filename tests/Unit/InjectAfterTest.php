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
        
        // assert key for next element
        $this->assertEquals(array_keys($res)[$indexOfInserted + 1], "aaa");
        // assert value for next element
        $this->assertEquals(array_values($res)[$indexOfInserted + 1], 7);
    }

    /** @test*/
    public function it_inserts_at_random_index_of_array_and_rest_of_array_stays_same(): void 
    {
        $array = ["foo" => 3, "bar" => 1, "bob" => 5, "gog" => 6];
        $randElement = array_rand($array);
        $res = injectAfter($array, $randElement, "aaa", 7);
        $indexOfInserted = array_search($randElement, array_keys($res));
        $leftPart = array_slice($res, 0, $indexOfInserted + 1);
        // skip inserted element, so + 2
        $rightPart = array_slice($res, $indexOfInserted + 2, count($res));

        // assert left part
        $this->assertEquals($leftPart, array_slice($array, 0, $indexOfInserted + 1));
        // assert right part
        $this->assertEquals($rightPart, array_slice($array, $indexOfInserted + 1, count($array)));
    } 

    /** @test*/
    public function it_inserts_at_random_index_of_array_and_replaces_value(): void 
    {
        $array = ["foo" => 3, "bar" => 1, "bob" => 5, "gog" => 6];
        $randElement = array_rand($array);
        $randElementToReplace = array_rand($array);
        $res = injectAfter($array, $randElement, $randElementToReplace, 7);
        $indexOfReplaced = array_search($randElementToReplace, array_keys($res));
        
        // assert value for replaced element
        $this->assertEquals($res[$randElementToReplace], 7);
        // assert value for replaced element
        $this->assertEquals(array_keys($res)[$indexOfReplaced], $randElementToReplace);
    }

    /** @test*/
    public function it_inserts_at_random_index_of_array_replaces_value_and_array_size_does_not_change(): void 
    {
        $array = ["foo" => 3, "bar" => 1, "bob" => 5, "gog" => 6];
        $randElement = array_rand($array);
        $randElementToReplace = array_rand($array);
        $res = injectAfter($array, $randElement, $randElementToReplace, 7);
        $indexOfReplaced = array_search($randElementToReplace, array_keys($res));
        
        // assert sizes of arrays
        $this->assertEquals(count($res), count($array));
    }
}