<?php


namespace app\controllers;

use app\models\News;
class NewsController extends Controller
{
    public function actionShow()
    {
        $news = News::getAll();
        echo $this->render('news', [
           'news' => $news,
            'title' => 'News'
        ]);
    }

    public function actionIndex()
    {
        echo $this->render('index');
    }
}