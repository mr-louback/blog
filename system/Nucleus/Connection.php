<?php

namespace system\Nucleus;
use PDO;
use PDOException;

class Connection
{
    private static $instance;
    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            try {
                self::$instance = new PDO('mysql:host=localhost;dbname='.DB_DATABASE, DB_USER, DB_PASSWORD, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_CASE => PDO::CASE_NATURAL,
                ]);
            } catch (PDOException $th) {
                die('Erro de conexão: ' . $th->getMessage());
            }
        }
        return self::$instance;
    }
   
}
