<?php

namespace system\Model;

use system\Nucleus\Connection as NucleusConnection;

class CategoryModel
{
    const TBL_CATEGORIES = 'categorias';

    /**
     * Summary of readAllCategory
     * @return array
     */
    public function readAllCategory(): array
    {
        $query = "SELECT * FROM " . self::TBL_CATEGORIES;
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    /**
     * Summary of insertLineCategory
     * @param array $dados
     * @return void
     */
    public function insertLineCategory(array $dados): void
    {
        $query = "INSERT INTO " . self::TBL_CATEGORIES . "( titulo, texto,status) VALUES ('$dados[titulo]','$dados[texto]',$dados[status])";
        $stmt = NucleusConnection::getInstance()->prepare($query);
        $stmt->execute();
    }
    /**
     * Summary of searchIdCategory
     * @param int $id
     * @return array
     */
    public function searchIdCategory(int $id): array
    {
        $query = "SELECT * FROM " . self::TBL_CATEGORIES . " WHERE id = {$id}";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    /**
     * Summary of searchCategoryTitle
     * @param int $id
     * @return mixed
     */
    public function searchCategoryTitle(int $id)
    {
        $query = "SELECT titulo FROM " . self::TBL_CATEGORIES . " WHERE id = {$id}";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetch();
        return $result;
    }
    /**
     * Summary of updateLineCategory
     * @param array $dados
     * @return void
     */
    public function updateLineCategory(array $dados): void
    {
        $query = "UPDATE " . self::TBL_CATEGORIES . " SET id = $dados[id], titulo ='$dados[titulo]', texto =  '$dados[texto]', status = $dados[status] WHERE id = $dados[id]";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
    }
    /**
     * Summary of deleteLineCategory
     * @param int $id
     * @return void
     */
    public function deleteLineCategory(int $id): void
    {
        $query = "DELETE FROM " . self::TBL_CATEGORIES . " WHERE id = {$id}";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
    }
}
