<?php

namespace system\Model;

use system\Nucleus\Connection as NucleusConnection;

class CategoryModel
{

    public function readAllCategory(): array
    {
        $query = "SELECT * FROM categorias";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function insertLineCategory(array $dados): void
    {
        $query = "INSERT INTO categorias( titulo, texto,status) VALUES ('$dados[titulo]','$dados[textarea]',$dados[select_status])";
        $stmt = NucleusConnection::getInstance()->prepare($query);
        $stmt->execute();
    }

    public function searchIdCategory(int $id): array
    {
        $query = "SELECT * FROM categorias WHERE id = {$id}";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function updateLineCategory(array $dados): void
    {
        $query = "UPDATE categorias SET id = $dados[id],titulo ='$dados[titulo]', texto =  '$dados[textarea]', status = $dados[select_status] WHERE id = $dados[id]";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
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
