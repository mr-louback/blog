<?php

namespace system\Nucleus;

use PDOException;
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
    public function search(?int $id = null, ?string $columns = '*')
    {
        if ($id) {
            $where = (" WHERE id = {$id}");
            $this->query = "SELECT {$columns} FROM " . $this->table . $where;
            $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
            $stmt->execute($this->parameters);
            return $stmt->fetchObject();
        }
        $this->query = "SELECT {$columns} FROM " . $this->table;
        $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
        $stmt->execute($this->parameters);
        return  $stmt->fetchAll();
    }
    public function countReigisters()
    {
        $this->query = "SELECT COUNT(*) FROM {$this->table}";
        $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function insertLineModel(array $dados)
    {
        $this->columns = implode(',', array_keys($dados));
        $this->values = implode(',', array_fill(0, count($dados), '?'));
        $this->query = "INSERT INTO {$this->table}({$this->columns}) VALUES ({$this->values})";
        $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
        $stmt->execute(array_values($dados));
    }
    public function updateLineModel(int $id, array $dados)
    {
        $setClause = implode('=?,', array_keys($dados)) . '=?';
        $this->query = "UPDATE {$this->table} SET {$setClause} WHERE id = ?";
        $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
        $stmt->execute(array_merge(array_values($dados), [$id]));
    }
    public function deleteLineModel(int $id)
    {
        $this->query = "DELETE FROM {$this->table} WHERE id = $id";
        $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
        $stmt->execute();
    }
}
