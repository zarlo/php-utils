<?php
use PHPUnit\Framework\TestCase;
use Zarlo\Utils\StringHelper;

final class StringHelperTest extends TestCase
{
    public function testReplace(): void
    {
        $this->assertEquals(
            "a_b-c",
            StringHelper::replace(["." => "_", "*" => "-" ], "a.b*c")
        );
    }

    public function testReplaceAnyWith(): void
    {
        $this->assertEquals(
            "a b c",
            StringHelper::replaceAnyWith([".", "*" ], " ", "a.b*c")
        );
    }


}


