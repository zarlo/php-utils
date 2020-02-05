<?php
namespace Zarlo\Utils;

class Maps {

    /**
     * @return string
    */
    private static function makeKeySafe(string $string)
    {
        return StringHelper::replaceAnyWith([" ", "."], "_", $string);
    } 

    /**
     * @return array
    */
    public static function manyMap(array $data)
    {
        $output = [];

        $current = 0;
        foreach ($data as $value)
        {

            $key = Maps::makeKeySafe($value);
            for($i = 0; $i < count($data); $i++)
            {
                if ($i == $current)
                    continue;
                $output = array_merge($output, [$key => $data[$i]]);
            }
            $current++;
        }
        
        return $output;
    }

    /**
     * @return array
    */
    public static function biMap(array $data)
    {
        $output = [];
        foreach ($data as $key => $value)
        {

            $key_key = Maps::makeKeySafe($key);
            $value_key = Maps::makeKeySafe($value);
            $output = array_merge($output, [$key_key => $value]);
            $output = array_merge($output, [$value_key => $key]);

        }
        return $output;
    }

}
