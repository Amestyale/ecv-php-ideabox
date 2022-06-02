<?php

class Model
{
    public function __set($name, $value)
    {
        $method = "set".ucwords(str_replace("_"," ",$name));
        if(method_exists($this, $method)) $this->{"set".ucfirst($name)}($value);
        else $this->$name = $value;
    }
}

?>