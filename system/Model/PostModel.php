<?php

namespace system\Model;

// use FTP\Connection;
// use PgSql\Connection;

use system\Nucleus\Connection as NucleusConnection;
use system\Nucleus\Helpers;

class PostModel
{
    public function lerTudo(): array
    {

        $query = "SELECT * FROM posts order by id";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function insertLine(): array
    {
        $query = "INSERT INTO `posts`( `titulo`, `texto`, `status`) VALUES ('titulo do texto 7','conteudo do texto 7',1)";

        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function updateLine(string $titulo, string $conteudo, int $id): array
    {
        $query = "UPDATE `posts` SET `titulo` = '$titulo', `texto` = '$conteudo' WHERE `posts`.`id` = $id";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function searchId(int $id ):bool|object
    {
        $where = ($id ? "WHERE id = {$id}" : '');
        $query = "SELECT * FROM posts $where";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetch();
        // echo var_dump($result);
        return $result;
    }
    public function busca(string $busca): array
    {
        $query = "SELECT * FROM posts where status = 1 and titulo like '%{$busca}%'";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
}
