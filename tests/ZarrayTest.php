<?php
use PHPUnit\Framework\TestCase;
use Zarlo\Utils\Zarray;

final class ZarrayTest extends TestCase
{

    public function testBasic(): void
    {

        $array = new Zarray();
        $array["test"] = "data";
        $this->assertEquals(
            ["test" => "data"],
            $array->to_array()
        );

    }

    public function testBasicPreset(): void
    {

        $array = new Zarray(["test" => "data"]);
        $this->assertEquals(
            ["test" => "data"],
            $array->to_array()
        );

    }

    public function testReset(): void
    {

        $array = new Zarray();
        $array["test"] = "data";
        $array["test"] = "data1";
        $this->assertEquals(
            ["test" => "data1"],
            $array->to_array()
        );
           
    }

    public function testBasicPresetReset(): void
    {

        $array = new Zarray(["test" => "data"]);
        $array["test"] = "data1";
        $this->assertEquals(
            ["test" => "data1"],
            $array->to_array()
        );

    }

    public function testGetItem(): void
    {

        $array = new Zarray(["test" => "data"]);
         
        $this->assertEquals(
            "data",
            $array["test"]
        );

    }

    public function testSetItem(): void
    {

        $array = new Zarray();
        $array["test"] = "data";
        $this->assertEquals(
            "data",
            $array["test"]
        );

    }

    public function testLength(): void
    {

        $array = new Zarray();
        $array["test"] = "data";
        $array["test2"] = "data";
        $array["test3"] = "data";

        $this->assertEquals(
            3,
            $array->length()
        );

    }

    public function testSetSubZarray(): void
    {

        $array = new Zarray();
        $array["test"] = "data";
        $array["test2"] = new Zarray(["test3" => "boop"]);

        $this->assertEquals(
            ["test" => "data", "test2" => ["test3" => "boop"]],
            $array->to_array()
        );

    }

    public function testSetSubArray(): void
    {

        $array = new Zarray();
        $array["test"] = "data";
        $array["test2"] = ["test3" => "boop"];

        $this->assertEquals(
            ["test" => "data", "test2" => ["test3" => "boop"]],
            $array->to_array()
        );

    }

    public function testMap(): void
    {

        $array = new Zarray();
        $array["test"] = "data";
        $array["test2"] = "boop";
        $array["test4"] = "cat";

        $this->assertEquals(
            ["test2" => "boop", "test4" => "beep"],
            $array->map(function ($key, $value) {
                if($key == "test4")
                {
                    return ["test4" => "beep"];
                }
                if($key !== "test")
                    return [$key => $value];
            })->to_array()
        );

    }

    public function testSet(): void
    {

        $array = new Zarray();
        $array["test2"] = "boop";
        $array->test4 = "beep";

        $this->assertEquals(
            ["test2" => "boop", "test4" => "beep"],
            $array->to_array()
        );

    }

    public function testGet(): void
    {

        $array = new Zarray();
        $array["test2"] = "boop";
        $array["test"] = "data";

        $this->assertEquals(
            "data",
            $array->test
        );

    }

}
