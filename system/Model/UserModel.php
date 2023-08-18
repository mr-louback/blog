<?php

namespace system\Model;

use mysqli;
use mysqli_stmt;
use PDOException;
use system\Nucleus\Config;
use system\Nucleus\Connection;
use system\Nucleus\Helpers;

class UserModel
{
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
     * Summary of getAllUsers
     * @return array
     */
    public function searchAllUsers()
    {
        $query = "SELECT * FROM usuarios ";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    /**
     * Summary of getUserId
     * @param int $id
     * @return mixed
     */
    public function searchUserId(int $id)
    {

        $where = ("WHERE id = {$id}" ?: '');
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
    /**
     * Summary of insertUser
     * @param array $dados
     * @return void
     */
    public function insertUser(array $dados): void
    {
        $hash = Helpers::generateEncript($dados['senha']);
        $query = "INSERT INTO usuarios( nome, level, email, senha, status) VALUES ( '$dados[nome]', $dados[level],'$dados[email]','{$hash}',$dados[status])";
        $stmt = Connection::getInstance()->prepare($query);
        $stmt->execute();
    }
    /**
     * Summary of updateUser
     * @param array $dados
     * @return void
     */
    public function updateUser(array $dados): void
    {
        $hash = Helpers::generateEncript($dados['senha']);

        // var_dump($password);
        $query = "UPDATE usuarios SET  id = $dados[id], nome='$dados[nome]',email='$dados[email]', level=$dados[level], senha='{$hash}', status=$dados[status] where id = $dados[id]";
        $stmt = Connection::getInstance()->prepare($query);
        $stmt->execute();
    }
    /**
     * Summary of deleteLineUser
     * @param int $id
     * @return void
     */
    public function deleteUserId(int $id): void
    {
        $query = "DELETE FROM usuarios WHERE id = $id";
        $stmt = Connection::getInstance()->query($query);
        $stmt->execute();
    }
}
