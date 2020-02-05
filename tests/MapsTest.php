<?php
use PHPUnit\Framework\TestCase;
use Zarlo\Utils\Maps;

final class MapTest extends TestCase
{
    public function testBiMap(): void
    {
        $this->assertEquals(
            [
                "a" => "ab", 
                "b" => "ba", 
                "ba" => "b", 
                "ab" => "a"],
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

}


