<?php


namespace app\controllers;

use app\interfaces\Renderable;
use app\models\User;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    protected $layout = 'main';
    private $useLayout = true;

    public function __construct(Renderable $render)
    {
        $this->render = $render;
    }

    public function runAction($action)
    {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            die("экшен не существует");
        }
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {

            return $this->renderTemplate("layouts/{$this->layout}", [
                'menu' => $this->renderTemplate('menu', $params),
                'auth' => $this->renderTemplate('auth', [
                    'isAuth' =>User::is_auth(),
                    'username' => User::getName(),
                ]),
                'content' => $this->renderTemplate($template, $params),
                'title' => $this->action,
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    protected function renderTemplate($template, $params = [])
    {
        return $this->render->renderTemplate($template, $params);
    }

}