<?php


namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class DbModel extends Model implements IModel
{
    abstract protected static function getTableName();

    protected $params = [];

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return DB::getInstance()->queryOneObject($sql, ['id' => $id], get_called_class());
    }

    public static function getOneWhereObject($key, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$key} = :value";
        return DB::getInstance()->queryOneObject($sql, ['value' => $value], static::class);
    }
    public static function getLimit($limit_from, $limit)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?, ?";
        return DB::getInstance()->queryLimit($sql, $limit_from, $limit);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";

        return DB::getInstance()->queryAll($sql);
    }

    protected function insert()
    {

        $columns = [];
        $params = [];
        foreach ($this as $key => $value) {
            if ($key === 'id') continue;
            if ($key === 'params') continue;
            if($key === 'errorMessage') continue;
            $params[":{$key}"] = $value;
            $columns[] = $key;
        }
        $tableName = $this->getTableName();
        $values = implode(', ', array_keys($params));
        $columns = implode(', ', $columns);
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        DB::getInstance()->execute($sql, $params);
        $this->id = DB::getInstance()->lastInsertId();
        return $this;
    }

    public function delete()
    {

        $tableName = $this->getTableName();
        $sql = "DELETE from {$tableName} where id = :id";
        $params[':id'] = $this->id;
        return DB::getInstance()->queryOne($sql, $params);
    }

    protected function update()
    {
        $arr = [];
        foreach ($this->params as $key => $val) {
            $arr[] = "{$key} = :{$key}";
        }
        $this->params[":id"] = $this->id;
        $values = implode(', ', $arr);
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET {$values} where id = :id";
        $params = $this->params;
        $this->params = [];
        return DB::getInstance()->execute($sql, $params);
    }

    public function save()
    {
        if (is_null($this->id)) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }

}