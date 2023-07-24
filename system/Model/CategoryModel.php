<?php

namespace system\Model;

// use FTP\Connection;
// use PgSql\Connection;

use system\Nucleus\Connection as NucleusConnection;
use system\Nucleus\Helpers;

class CategoryModel
{

    public function lerTudoCategory(): array
    {

        $query = "SELECT * FROM categorias order by id";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function insertLineCategory(): array
    {
        $query = "INSERT INTO `categorias`( `titulo`, `texto`, `status`) VALUES ('titulo do texto 7','conteudo do texto 7',1)";

        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function updateLineCategory(string $titulo, string $conteudo, int $id): array
    {
        $query = "UPDATE `categorias` SET `titulo` = '$titulo', `texto` = '$conteudo' WHERE `categorias`.`id` = $id";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function searchIdCategory(int $id): array
    {

        $query = "SELECT * FROM posts WHERE categoria_id = {$id}";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // echo var_dump($result);
        return $result;
    }
    public function lerStatusCategory(): array
    {
        $query = "SELECT * FROM categorias where status = 0";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
}
