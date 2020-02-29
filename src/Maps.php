<?php
namespace Zarlo\Utils;

class Maps {

    /**
     * @return string
    */
    private static function makeKeySafe(string $string) : string
    {
        return StringHelper::replaceAnyWith([" ", "."], "_", $string);
    } 

    /**
     * @return array
    */
    public static function manyMap($data) : array
    {
        $output = new Zarray();
        $data = Zarray::makeArray($data);
        $current = 0;
        foreach ($data as $value)
        {

            $key = Maps::makeKeySafe($value);
            for($i = 0; $i < count($data); $i++)
            {
                if ($i == $current)
                    continue;
                $output->append([$key => $data[$i]]);
            }
            $current++;
        }
        
        return $output->to_array();
    }

    /**
     * @return array
    */
    public static function biMap($data) : array
    {
        $output = new Zarray();
        $data = Zarray::makeArray($data);
        foreach ($data as $key => $value)
        {

            $key_key = Maps::makeKeySafe($key);
            $value_key = Maps::makeKeySafe($value);
            $output->append([$key_key => $value]);
            $output->append([$value_key => $key]);

        }
        return $output->to_array();
    }

}
