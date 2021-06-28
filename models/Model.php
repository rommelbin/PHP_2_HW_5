<?php

namespace app\models;


abstract class Model
{
    public function __get($key)
    {
        return $this->$key;
    }

    public function __set($key, $val)
    {
        if (property_exists($this, $key)) {
            $this->$key = $val;
            $this->params["{$key}"] = $val;
        }
    }

    public function __isset($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        } else {
            return false;
        }

    }
}