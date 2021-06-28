<?php
// TODO доделать User authentication, сделать через кукис.
// TODO прочитать наконец-то SOLID принципы.
// TODO проверить проект на MVC



session_start(); // TODO придумать как это тоже поменять
use app\models\{Product, User};
use app\engine\{Autoload, Render, twigRender, Request};
use  app\controllers\ProductController;

include '../vendor/autoload.php';
include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

/** @var Product $product */
/** @var User $user */


$request = new Request();


$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
/** @var $controller ProductController */
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName);
} else {
    echo "404";
}
die();
