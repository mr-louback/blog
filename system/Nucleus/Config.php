<?php

namespace system\Nucleus;

use Dotenv\Dotenv;

class Config
{
    
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__, '../../.env');
        $dotenv->load();
    }
    public function getDBConfig()
    {
        return [
            'db_host' => $_ENV['DB_HOST'],
            'db_name' => $_ENV['DB_DATABASE'],
            'db_user' => $_ENV['DB_USER'],
            'db_password' => $_ENV['DB_PASSWORD'],
        ];
    }
}
