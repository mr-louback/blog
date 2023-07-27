<?php

namespace system\Model;

// use FTP\Connection;
// use PgSql\Connection;

use system\Nucleus\Connection as NucleusConnection;
use system\Nucleus\Helpers;

class CategoryModel
{

    public function readAllCategory(): array
    {

        $query = "SELECT * FROM categorias order by id";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function insertLineCategory(array $dados): void
    {
        // $query = "INSERT INTO `posts`( `categoria_id`, `titulo`, `texto`, `status`) VALUES ($dados[categoria_id],'$dados[titulo]','$dados[textarea]',$dados[select_status])";
        $query = "INSERT INTO categorias( titulo, texto,status) VALUES ('$dados[titulo]','$dados[textarea]',$dados[select_status])";
        $stmt = NucleusConnection::getInstance()->prepare($query);
        $stmt->execute();
    }

    public function searchIdCategory(int $id): array
    {
        $query = "SELECT * FROM categorias WHERE id = {$id}";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // echo var_dump($result);
        return $result;
    }
    public function updateLineCategory(array $dados): void
    {
        // UPDATE `categorias` SET `titulo` = 'abc', `texto` = 'cbcvbcvbcvb' WHERE `categorias`.`id` = 156;
        $query = "UPDATE categorias SET id= $dados[id], titulo ='$dados[titulo]', texto = '$dados[textarea]',status= $dados[select_status]  WHERE  'categorias'.'id' $dados[id]";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
        // var_dump($result);
        // return $result;
    }
    // public function lerStatusCategory(): array
    // {
    //     $query = "SELECT * FROM categorias where status = 0";
    //     $stmt = NucleusConnection::getInstance()->query($query);
    //     $result = $stmt->fetchAll();
    //     // var_dump($result);
    //     return $result;
    // }
}
