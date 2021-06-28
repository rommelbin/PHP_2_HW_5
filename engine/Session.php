<?php


namespace app\engine;


class Session
{
    public $session_id;
    public $params = [];

    public function __construct()
    {
        $this->parseSession();
    }

    public function parseSession()
    {
        $this->session_id = session_id();
        $this->params = $_SESSION;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    public function regenerateSession()
    {
        session_regenerate_id();
    }

    public function destroySession()
    {
        session_destroy();
    }

    public function setParam($name, $value)
    {
        $_SESSION["{$name}"] = $value;
    }
}