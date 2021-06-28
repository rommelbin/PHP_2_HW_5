<?php


namespace app\models;


class News extends DbModel
{

    protected $id;
    protected $title;
    protected $text;

    public function __construct($title = null, $text = null)
    {
        $this->title = $title;
        $this->text = $text;
    }


    public static function getTableName() {
        return 'news';
    }

}