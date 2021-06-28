<?php

namespace app\models;

class Product extends DbModel
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $consistOf;
    protected $manufacturer;

    public function __construct($name = null, $description = null, $price = null, $consistOf = null, $manufacturer = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->consistOf = $consistOf;
        $this->manufacturer = $manufacturer;
    }


    protected static function getTableName()
    {
        return 'items';
    }
}


