<?php


namespace app\engine;

use app\interfaces\Renderable;

class twigRender implements Renderable
{
    protected $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../twigtemplates');
        $this->twig = new \Twig\Environment($loader);
    }

    public function renderTemplate($template, $params = [])
    {
        echo $this->twig->render($template . '.twig', $params);
    }


}