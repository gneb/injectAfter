<?php

namespace Tests\Unit;

use App;
use PHPUnit\Framework\TestCase;

class InjectAfterTEst extends TestCase
{
    /** @test*/
    public function it_inserts_to_array(): void 
    {
        $res = injectAfter(["foo" => 3, "bar" => 1, "bob" => 5, "gog" => 6], 'bbb', 'aaa', 7);
        $excepted = 5;
        $this->assertEquals($excepted, count($res));
    }
}