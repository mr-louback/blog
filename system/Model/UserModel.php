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
}
