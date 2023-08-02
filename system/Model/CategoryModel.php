<?php

namespace system\Model;

use system\Nucleus\Connection as NucleusConnection;
use system\Nucleus\Model;
class CategoryModel 
{
    // public function __construct()
    // {
    //     parent::__construct('categorias');

    // }
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
        $query = "UPDATE categorias SET id = $dados[id], titulo ='$dados[titulo]', texto =  '$dados[textarea]', status = $dados[select_status] WHERE id = $dados[id]";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
    }
    public function deleteLineCategory(int $id): void
    {
        // "DELETE FROM `categorias` WHERE `categorias`.`id` = 9"?

        $query = "DELETE FROM categorias WHERE `categorias`.`id` = {$id}";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
    }

}
