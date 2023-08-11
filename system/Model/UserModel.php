<?php

namespace system\Model;

use PDOException;
use system\Nucleus\Connection;
use system\Nucleus\Helpers;
use system\Nucleus\RenderMessage;

class UserModel
{
    public function getUserEmail(array $dados)
    {
        $where = ("WHERE email = '{$dados['email']}'" ?: '');
        $query = "SELECT email FROM usuarios {$where}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetch();
        // var_dump($result);
        return $result;
    }
    public function getUser(array $dados)
    {
        $where = ("WHERE email = '{$dados['email']}'" ?: '');
        $query = "SELECT * FROM usuarios {$where}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetch();

        // var_dump($result->email);
        return $result;
    }
    public function getAllUsers()
    {
        $query = "SELECT * FROM usuarios ";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);

        return $result;
    }
    /**
     * Summary of getUserId
     * @param int $id
     * @return mixed
     */
    public function getUserId(int $id)
    {
        $where = ("WHERE id = {$id}" ?: '');
        $query = "SELECT * FROM usuarios {$where}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetch();
        // var_dump($result);

        return $result;
    }
    /**
     * Summary of updateUser
     * @param array $dados
     * @return void
     */
    public function updateUser(array $dados): void
    {
        $query = "UPDATE usuarios SET  nome='$dados[nome]', level=$dados[level], senha='$dados[senha]', status=$dados[status] where id = $dados[id]";
        // var_dump($query);
        $stmt = Connection::getInstance()->prepare($query);
        $stmt->execute();
    }
    /**
     * Summary of updateLastLog
     * @param int $userId
     * @return void
     */
    public function updateLastLog(int $userId): void
    {
        $ultimo_login = date('Y-m-d H:i:s');
        // var_dump($ultimo_login);
        $query = "UPDATE usuarios SET ultimo_login = '{$ultimo_login}' WHERE id = {$userId}";
        $stmt = Connection::getInstance()->prepare($query);
        $stmt->execute();
    }
    public function insertUser(array $dados): void
    {
        $query = "INSERT INTO usuarios( nome, level, email, senha, status) VALUES ( '$dados[nome]', $dados[level],'$dados[email]','$dados[senha]',$dados[status])";
        // var_dump($query);
        
        $stmt = Connection::getInstance()->prepare($query);
        $stmt->execute();
        
    }
    public function deleteLineUser(int $id): void
    {
        $query = "DELETE FROM usuarios WHERE id = $id";
        $stmt = Connection::getInstance()->query($query);
        $stmt->execute();
    }
}
