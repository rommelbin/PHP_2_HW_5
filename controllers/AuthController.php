<?php


namespace app\controllers;

use app\engine\Request;
use app\engine\Session;
use app\models\User;

class AuthController extends Controller
{

    public function actionLogin()
    {
        $request = new Request();
        /** @var string $login
         * @var string $password
         * @var string $save
         */
        extract($request->getParams());
        if (User::auth($login, $password)) {
            if(isset($save)) {
                $user = User::getOneWhereObject('login', $login);
                $user->hash = uniqid(rand(), true);
                setcookie('hash', $user->hash, time() + 3600, '/' );
                $user->save();
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }
    }

    public function actionLogout()
    {
        setcookie('hash', '', time() - 3600, '/');
        (new Session())->regenerateSession();
        (new Session())->destroySession();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }

    public function actionIndex()
    {
        echo $this->render('index');
    }
}