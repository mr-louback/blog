<?php

namespace system\Model;

use system\Nucleus\Connection;

class UserModel
{

    public function getUserByEmail(array $dados)
    {
        $where = ("WHERE email = '{$dados['email']}'" ?: '');
        $query = "SELECT email FROM usuarios {$where}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);

        return $result;
    }
    public function getUserByPassword(array $dados)
    {
        $where = ("WHERE senha = '{$dados['senha']}'" ?: '');
        $query = "SELECT senha FROM usuarios {$where}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function getUserByName(array $dados)
    {
        $where = ("WHERE email = '{$dados['email']}'" ?: '');
        $query = "SELECT nome FROM usuarios {$where}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
   
}
