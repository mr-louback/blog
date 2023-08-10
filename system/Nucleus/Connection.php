<?php

namespace system\Nucleus;

use PDO;
use PDOException;
use system\Nucleus\Config;
class Connection
{
    private static $instance;
    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            try {
                $db_config = (new Config())->getDBConfig();
                $dsn = "mysql:host={$db_config['db_host']};dbname={$db_config['db_name']}";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_CASE => PDO::CASE_NATURAL,
                ];
                self::$instance = new PDO($dsn, $db_config['db_user'], $db_config['db_password'], $options);
            } catch (PDOException $th) {
                die('Erro de conexão: ' . $th->getMessage());
            }
        }
        return self::$instance;
    }
}
