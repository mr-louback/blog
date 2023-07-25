<?php

namespace system\Model;

use system\Nucleus\Connection as NucleusConnection;
use system\Nucleus\Helpers;

class UserModel
{
    public function userModelInsertLine(string $name, string $email, string $passw, string $hash):array
    {
        $query = "INSERT INTO tbl_user( user_name, user_email, user_password, user_hash) VALUES ('$name','$email','$passw','$hash')";

        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetch();
        echo var_dump($result);
        return $result ;
    }
   
}
