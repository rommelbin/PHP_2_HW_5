<?php


namespace app\models;


class Order extends DbModel
{
    protected $id;
    protected $session_id;
    protected $status;
    protected $num;
    protected $user_login;
    protected $user_id;

    public function __construct($session_id = null, $status = null, $num = null, $user_login = null, $user_id = null)
    {
        $this->session_id = $session_id;
        $this->status = $status;
        $this->num = $num;
        $this->user_login = $user_login;
        $this->user_id = $user_id;
    }
    public static function getTableName() {
        return 'orders';
    }
}