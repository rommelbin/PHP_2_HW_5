<?php


namespace app\models;


class BasketProduct extends DbModel
{
    protected $id;
    protected $item_id;
    protected $session_id;
    protected $quantity;

    public function __construct($item_id = null, $user_id = null, $session_id = null, $quantity = null)
    {
        $this->item_id = $item_id;
        $this->session_id = $session_id;
        $this->quantity = $quantity;
    }


    public static function getTableName() {
        return 'basket_products';
    }

}