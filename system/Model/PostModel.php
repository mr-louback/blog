<?php

namespace system\Model;

// use FTP\Connection;
// use PgSql\Connection;

use system\Nucleus\Connection as NucleusConnection;

class PostModel
{
    public function lerTudo(): array
    {

        $query = "SELECT * FROM posts ";
        $stmt = NucleusConnection::getIntancia()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function insertLine(): array
    {
        $query = "INSERT INTO `posts`( `titulo`, `texto`, `status`) VALUES ('titulo do texto 7','conteudo do texto 7',1)";

        $stmt = NucleusConnection::getIntancia()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function updateLine(string $titulo, string $conteudo, int $id): array
    {
        $query = "UPDATE `posts` SET `titulo` = '$titulo', `texto` = '$conteudo' WHERE `posts`.`id` = $id";
        $stmt = NucleusConnection::getIntancia()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function searchId(int $id ):bool|object
    {
        $where = ($id ? "WHERE id = {$id}" : '');
        $query = "SELECT * FROM posts $where";
        $stmt = NucleusConnection::getIntancia()->query($query);
        $result = $stmt->fetch();
        // echo var_dump($result);
        return $result;
    }
    public function lerStatus(): array
    {
        $query = "SELECT * FROM posts where status = 0";
        $stmt = NucleusConnection::getIntancia()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
}
