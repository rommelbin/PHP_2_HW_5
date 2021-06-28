<?php


namespace app\interfaces;


interface Renderable
{
    public function RenderTemplate($template, $params = []);
}