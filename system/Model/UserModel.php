<?php

namespace system\Model;

use system\Nucleus\Connection;

class UserModel
{
    public function getUser(array $dados)
    {
        $where = ("WHERE email = '{$dados['email']}'" ?: '');
        $query = "SELECT * FROM usuarios {$where}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetch();
        // var_dump($result);

        return $result;
    }
    public function getUserId(int $id)
    {
        $where = ("WHERE id = {$id}" ?: '');
        $query = "SELECT * FROM usuarios {$where}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetch();
        // var_dump($result);

        return $result;
    }
    public function updateLastLog(int $userId): void
    {
        $ultimo_login = date('Y-m-d H:i:s');
        // var_dump($ultimo_login);
        $query = "UPDATE usuarios SET ultimo_login = '{$ultimo_login}' WHERE id = {$userId}";
        $stmt = Connection::getInstance()->prepare($query);
        $stmt->execute();
    }
}
