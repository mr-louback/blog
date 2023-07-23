<?php

namespace system\Model;

// use FTP\Connection;
// use PgSql\Connection;

use system\Nucleus\Connection as NucleusConnection;
use system\Nucleus\Helpers;

class CategoryModel
{
    public function lerTudo(): array
    {

        $query = "SELECT * FROM categorias order by id";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function insertLine(): array
    {
        $query = "INSERT INTO `categorias`( `titulo`, `texto`, `status`) VALUES ('titulo do texto 7','conteudo do texto 7',1)";

        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function updateLine(string $titulo, string $conteudo, int $id): array
    {
        $query = "UPDATE `categorias` SET `titulo` = '$titulo', `texto` = '$conteudo' WHERE `categorias`.`id` = $id";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function searchId(int $id ):bool|object
    {
        $where = ($id ? "WHERE id = {$id}" : '');
        $query = "SELECT * FROM categorias $where";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetch();
        // echo var_dump($result);
        return $result;
    }
    public function lerStatus(): array
    {
        $query = "SELECT * FROM categorias where status = 0";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
}
