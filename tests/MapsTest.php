<?php
use PHPUnit\Framework\TestCase;
use Zarlo\Utils\Maps;
use Zarlo\Utils\Zarray;

final class MapTest extends TestCase
{
    public function testBiMap(): void
    {
        $this->assertEquals(
            [
                "a" => "ab", 
                "b" => "ba", 
                "ba" => "b", 
                "ab" => "a"
            ],
            Maps::biMap(["a" => "ab", "b" => "ba"])
        );
    }

    public function testManyMap(): void
    {
        $this->assertEquals(
            [
                "a" => "ab", 
                "a" => "ac", 
                "ab" => "a",
                "ab" => "ac",
                "ac" => "a",
                "ac" => "ab"
            ],
            Maps::manyMap(["a", "ab", "ac"])
        );
    }

    public function testZarrayBiMap(): void
    {
        $this->assertEquals(
            [
                "a" => "ab", 
                "b" => "ba", 
                "ba" => "b", 
                "ab" => "a"
            ],
            Maps::biMap(new Zarray(["a" => "ab", "b" => "ba"]))
        );
    }

    public function testZarrayManyMap(): void
    {
        $this->assertEquals(
            [
                "a" => "ab", 
                "a" => "ac", 
                "ab" => "a",
                "ab" => "ac",
                "ac" => "a",
                "ac" => "ab"
            ],
            Maps::manyMap(new Zarray(["a", "ab", "ac"]))
        );
    }

}


