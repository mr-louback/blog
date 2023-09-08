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
    protected $like;
    public function __construct(string $table)
    {
        $this->table = $table;
    }
    public function order(string $order)
    {
        $this->order = " ORDER BY {$order}";
        return $this;
    }
    public function limit(int $limit)
    {
        $this->limit = " limit {$limit}";
        return $this;
    }
    public function offset(string $offset)
    {
        $this->offset = " offset {$offset}";
        return $this;
    }
    public function like(string $like)
    {
        $this->like = " WHERE titulo LIKE $like";
        return $this;
    }
    public function search(?int $id = null, ?string $columns = '*')
    {

        try {
            if ($id !== null) {
                $where = (" WHERE id = {$id}");
                $this->query = "SELECT {$columns} FROM " . $this->table . $where;
                $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
                $stmt->execute();
                return $stmt->fetchObject(static::class);
            }

            $this->query = "SELECT {$columns} FROM " . $this->table;
            $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
            $stmt->execute();
            return  $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
        } catch (PDOException $th) {
            if ($th) {
                echo 'erro search' . $th->getMessage();
            }
        }
    }
    public function searchSlug(string $slug)
    {
        try {
            if ($slug) {
                $where = (" WHERE slug = '{$slug}' ");
                $this->query = "SELECT * FROM " . $this->table . $where;
                $stmt = Connection::getInstance()->prepare($this->query);
                // var_dump($stmt);
                $stmt->execute();
                return $stmt->fetchObject(static::class);
            }
        } catch (PDOException $th) {
            if ($th) {
                echo 'erro searchSlug' . $th->errorInfo;
            }
        }
    }
    public function countRegisters(?string $status = '')
    {
        try {
            if ($status == 0) {
                $this->query = "SELECT COUNT(*) FROM {$this->table} WHERE status = {$status}";
                $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
                $stmt->execute();
                return $stmt->fetchColumn();
            } else if ($status == 1) {
                $this->query = "SELECT COUNT(*) FROM {$this->table} WHERE status = {$status}";
                $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
                $stmt->execute();
                return $stmt->fetchColumn();
            } else {
                $this->query = "SELECT COUNT(*) FROM {$this->table} ";
                $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
                $stmt->execute();
                return $stmt->fetchColumn();
            }
        } catch (PDOException $th) {
            if ($th) {
                echo 'erro countRegisters' . $th->errorInfo;
            }
        }
    }
    public function insertLineModel(array $dados)
    {
        try {
            $this->columns = implode(',', array_keys($dados));
            $this->values = implode(',', array_fill(0, count($dados), '?'));
            $this->query = "INSERT INTO {$this->table}({$this->columns}) VALUES ({$this->values})";
            $stmt = Connection::getInstance()->prepare($this->query);
            $stmt->execute(array_values($dados));
        } catch (PDOException $th) {
            if ($th->getCode() == 1062) {
                echo ('erro insertLineModel ' . $th->getMessage());
            }
        }
    }
    public function updateLineModel(int $id, array $dados)
    {
        try {
            $setClause = implode('=?,', array_keys($dados)) . '=?';
            $this->query = "UPDATE {$this->table} SET {$setClause} WHERE id = ?";
            $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
            $stmt->execute(array_merge(array_values($dados), [$id]));
        } catch (PDOException $th) {
            if ($th->errorInfo) {
                echo 'erro updateLineModel' . $th->getMessage();
            }
        }
    }
    public function deleteLineModel(int $id)
    {
        try {
            $this->query = "DELETE FROM {$this->table} WHERE id = $id";
            $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
            $stmt->execute();
        } catch (PDOException $th) {
            if ($th) {
                echo 'erro deleteLineModel' . $th->errorInfo;
            }
        }
    }
}
