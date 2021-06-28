<?php

namespace app\controllers;


use app\engine\Request;
use app\models\Product;

class ProductController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }
    public function actionCatalog()
    {
        extract((new Request())->getParams());
        $page = $page ?? 0;
        if($page === 0) {
            $from = 0;
            $to = 5;
        } else {
            $from = $page * 5;
            $to = 5;
        }
        $catalog = Product::getLimit($from, $to);
        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        /**
         * @var integer $id
         */
        extract((new Request())->getParams());


        $good = Product::getOne($id);
        echo $this->render('card', [
            'good' => $good
        ]);
    }
}