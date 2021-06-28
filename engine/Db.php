<?php

namespace app\engine;

use app\traits\TSinletone;

class Db
{
    protected $config = [
        'driver' => 'mysql',
        'host' => 'localhost:3306',
        'login' => 'rommelbin',
        'password' => 'rom',
        'database' => 'PHP_2',
        'charset' => 'utf8'
    ];

    use TSinletone;

    protected $connection = null;

    protected function getConnection()
    {
        if (is_null($this->connection)) {
            $this->connection = new \PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }

        return $this->connection;
    }
    public function queryLimit($sql, $limit, $limit_from) {
        //LIMIT 0, $limit
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->bindValue(2, $limit_from, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    protected function prepareDsnString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    public function lastInsertId(): string {
        return $this->getConnection()->lastInsertId();
    }

    //SELECT * FROM `products` WHERE id = :id AND name = :name
    //$params = ['id' => 3, 'name' => 'alex'];
    private function query($sql, $params) {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function queryOneObject($sql, $params, $class)
    {
        $stmt = $this->query($sql, $params);

        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,  $class);
        return $stmt->fetch();
    }

    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }

}