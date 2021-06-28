<?php


namespace app\models;


class Review extends DbModel
{
    protected $name;
    protected $review;
    protected $item_id;
    protected $id;

    public function __construct($name = null, $review = null, $item_id = null)
    {
        $this->name = $name;
        $this->review = $review;
        $this->item_id = $item_id;
    }

    public static function getTableName() {
        return 'reviews';
    }

}