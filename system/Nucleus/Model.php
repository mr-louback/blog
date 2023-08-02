<?php

namespace system\Nucleus;

use system\Nucleus\Connection;

class Model
{
    protected $dados;
    protected $query;
    protected $error;
    protected $parameters;
    protected $table;
    protected $order;
    protected $limit;
    protected $columns;
    protected $values;
    protected $offset;
    public function __construct(string $table)
    {
        $this->table = $table;
    }
    public function order(string $order)
    {
        $this->order = " ORDER BY {$order}";
        return $this;
    }
    public function limit(string $limit)
    {
        $this->limit = " limit {$limit}";
        return $this;
    }
    public function offset(string $offset)
    {
        $this->offset = " offset {$offset}";
        return $this;
    }
    public function search(?string $terms = null, ?string $parameters = null, string $columns = '*')
    {
        if ($terms) {
            $this->query = "SELECT {$columns} FROM " . $this->table . "WHERE {$terms}";
            parse_str($parameters, $this->parameters);
            return $this;
        }
        $this->query = "SELECT {$columns} FROM " . $this->table;
        return $this;
    }
    public function result(bool $all = false)
    {
        try {
            $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
            $stmt->execute($this->parameters);
            if (!$stmt->rowCount()) {
                return null;
            }
            if ($all) {
                return $stmt->fetchAll();
            }
            return $stmt->fetchObject();
        } catch (\PDOException $ex) {
            $this->error = $ex;
        }
    }
    protected function insertLineModel(array $dados)
    {
        try {

            $this->columns = implode(',', array_keys($dados));
            $query = "INSERT INTO categorias({$this->columns}) VALUES ('$dados[titulo]','$dados[texto]',$dados[status])";
            $stmt = Connection::getInstance()->prepare($query);
            $stmt->execute();
            return Connection::getInstance()->lastInsertId();
        } catch (\PDOException $th) {
            echo $this->error = $th;
            return null;
        }
    }
    private function filter(array $dados)
    {
        $filter = [];
        foreach ($dados as $key => $value) {
            $filter[$key] = is_null($value) ? null : filter_var($value, FILTER_DEFAULT);
        }
    }
}
