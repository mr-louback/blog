<?php

namespace system\Model;


use system\Nucleus\Connection;
use system\Nucleus\Model;
use system\Nucleus\Helpers;


class UserModel extends Model
{
    public function __construct()
    {
        $this->table = 'usuarios';
    }
    /**
     * Summary of getUserEmail
     * @param array $dados
     * @return mixed
     */
    public function searchUserEmail(array $dados)
    {
        $where = ("WHERE email = '{$dados['email']}'" ?: '');
        $query = "SELECT * FROM usuarios {$where}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetch();
        return $result;
    }
    /**
     * Summary of updateLastLog
     * @param int $userId
     * @return void
     */
    public function updateLastLog(int $userId): void
    {
        $ultimo_login = date('Y-m-d H:i:s');
        $query = "UPDATE usuarios SET ultimo_login = '{$ultimo_login}' WHERE id = {$userId}";
        $stmt = Connection::getInstance()->prepare($query);
        $stmt->execute();
    }
    public function updateLineUser(int $id, array $dados)
    {
        $dados['senha'] = [Helpers::generateEncript($dados['senha'])][0];
        $setClause = implode('=?,', array_keys($dados)) . '=?';
        $this->query = "UPDATE {$this->table} SET {$setClause} WHERE id = ?";
        $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
        $stmt->execute(array_merge(array_values($dados), [$id]));
    }
    public function insertLineUser(array $dados)
    {
        $dados['senha'] = [Helpers::generateEncript($dados['senha'])][0];
        $this->columns = implode(',', array_keys($dados));
        $this->values = implode(',', array_fill(0, count($dados), '?'));
        $this->query = "INSERT INTO {$this->table}({$this->columns}) VALUES ({$this->values})";
        $stmt = Connection::getInstance()->prepare($this->query . $this->order . $this->limit . $this->offset);
        $stmt->execute(array_values($dados));
    }
}
