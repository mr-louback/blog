<?php

namespace system\Model;


use system\Nucleus\Connection;
use system\Nucleus\Helpers;
use system\Nucleus\Model;

class UserModel extends Model
{
    const TBL_USERS = 'usuarios';
    public function __construct()
    {
        $this->table = self::TBL_USERS;
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
    
}
