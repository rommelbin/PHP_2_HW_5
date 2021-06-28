<?php

namespace app\models;


use app\engine\Session;

class User extends DbModel
{
    protected $id;
    protected $login;
    protected $pass;
    protected $hash;
    protected $email;

    public function __construct($login = null, $pass = null, $email = null, $hash = null)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->email = $email;
        $this->hash = $hash;
    }


    public static function getTableName()
    {
        return 'users';
    }

    public static function auth($login, $password)
    {
        $user = User::getOneWhereObject('login', $login);
        if (is_object($user)) {
            if (password_verify($password, $user->pass)) {
                (new Session())->setParam('login', $login);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function is_auth()
    {
        if (isset($_COOKIE['hash'])) {
            $hash = $_COOKIE['hash'];
            $user = User::getOneWhereObject('hash', $hash);
            if (is_object($user)) {
                $login = $user->login;
                $id = $user->id;
                (new Session())->setParam('login', $login);
                (new Session())->setParam('id', $id);
            }
        }
        return isset((new Session())->getParams()['login']);
    }

    public static function getName()
    {
        return (new Session())->getParams()['login'] ?? null;
    }


    public static function checkLogin($login)
    {
        $user = User::getOneWhereObject('login', $login);
        if (is_object($user)) {
            return true;
        } else {
            return false;
        }
    }
}