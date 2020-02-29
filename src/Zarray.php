<?php
namespace Zarlo\Utils;

// i wanted a OOP array so now i have one
class Zarray implements \ArrayAccess, \Iterator {

    public static function makeArray($array)
    {
        if($array instanceof Zarray)
            return $array->to_array();
        return $array;
    }

    private $trueArray;
    private $hasZarray = false;

    function __construct(?array $data = array())
    {
        $this->trueArray = $data;
    }

    public function __get($name) 
    {
        return $this->offsetGet($name);
    }

    public function __set($name, $value) 
    {
        $this->offsetSet($name, $value);
    }

    //ArrayAccess function

    public function offsetSet($offset, $value) : void
    {
        if($value instanceof Zarray)
            $this->hasZarray = true;
        if(is_array($value))
        {
            $value = new Zarray($value);
            $this->hasZarray = true;
        }

        if (is_null($offset)) {
            $this->trueArray[] = $value;
        } else {
            $this->trueArray[$offset] = $value;
        }
    }

    public function offsetExists($offset) : bool
    {
        return isset($this->trueArray[$offset]);
    }

    public function offsetUnset($offset) : void 
    {
        unset($this->trueArray[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->trueArray[$offset]) ? $this->trueArray[$offset] : null;
    }

    public function length() : int
    {
        return count($this->trueArray);
    }

    public function append($data) : void
    {
        $this->trueArray = array_merge($this->trueArray, $data);
    }

    public function prepend($data) : void
    {
        $this->trueArray = array_unshift($this->trueArray, $data);
    }

    public function pop($data, $index = 0)
    {
        if($index == 0)
            return array_pop($this->trueArray);
        if($index < 0)
            $index = $this->length() + $index;
        $item = $this->trueArray[$index];
        unset($this->trueArray[$index]);
        return $index;
    }

    //Iterator functions 
    public function map(callable $fn) : Zarray
    {
        $new = new Zarray();
        foreach ($this->trueArray as $key => $value)
        {
            $newItem = $fn($key, $value);
            if(isset($newItem))
                $new->append($newItem);
        }
          
        return $new;
    }

    public function rewind()
    {
        reset($this->trueArray);
    }
    
    public function current() 
    {
        return current($this->trueArray);
    }
    
    public function key()
    {
        return key($this->trueArray);
    }
    
    public function next() 
    {
        return next($this->trueArray);
    }
    
    public function valid() : bool
    {
        return $this->current() !== false;
    }    

    //Helper functions
    public function toArray($depth = -1) : array
    {
        return $this->to_array();
    }

    public function to_array($depth = -1) : array
    {
        if($depth == 0)
            return null;
            
        if($depth !== -1)
            $depth--;

        if(!$this->hasZarray)
            return $this->trueArray;

        $output = $this->trueArray;
        foreach ($output as $key => $value)
        {
            if($value instanceof Zarray)
            {
                $output[$key] = $value->to_array($depth);
            }
        }
        return $output;
    }

    public function __toString() : string
    {
        return json_encode($this->to_array());
    }

}