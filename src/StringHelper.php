<?php
namespace Zarlo\Utils;

class StringHelper {

    public static function replaceAnyWith(array $data, string $with, string $string) : string
    {

        foreach($data as $value)
            $string = str_replace($value, $with, $string);
        return $string;
    }

    public static function replace(array $data, string $string) : string
    {

        foreach($data as $key => $value)
            $string = str_replace($key, $value, $string);
        return $string;
    }

}