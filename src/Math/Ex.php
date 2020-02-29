<?php
namespace Zarlo\Utils\Math;

class Ex {
    public static function Fac($i)
    {
        if($i == 0)
            return 1;
        if($i == 1)
            return 0;
        if($i == 2)
            return 2;
        return Ex::Fac($i - 1) * $i;
    }
}