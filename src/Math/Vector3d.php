<?php
namespace Zarlo\Utils\Math;

class Vector3d {

    public $x, $y, $z = 0;
    
    public function distance(Vector3d $other)
    {
        return sqrt(($other->x - $this->x)^2 + ($other->y - $this->y)^2 + ($other->z - $this->z)^2);
    }

}

