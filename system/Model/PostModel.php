<?php

namespace system\Model;

use system\Nucleus\Connection;
use system\Nucleus\Helpers;
use system\Nucleus\Model;

class PostModel
{
    const TBL_POSTS = 'posts';

    public function readAllPosts(): array
    {
        $query = "SELECT * FROM " . self::TBL_POSTS;
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    /**
     * Summary of readPostsCreated
     * @return mixed
     */
    public function readPostsCreated(int $id)
    {
        $query = "SELECT * FROM " . self::TBL_POSTS ." WHERE id = {$id}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetch();
        return $result->created_at ;
    }
    public function searchCategoryId(int $id): array
    {
        $query = "SELECT categoria_id FROM " . self::TBL_POSTS . " WHERE categoria_id = {$id}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function insertLinePosts(array $dados): void
    {
        $query = "INSERT INTO " . self::TBL_POSTS . "( categoria_id, titulo, texto, status) VALUES ( $dados[categoria_id],'$dados[titulo]','$dados[texto]',$dados[status])";
        $stmt = Connection::getInstance()->prepare($query);
        $stmt->execute();
    }
    public function searchIdPost(int $id): array
    {
        $where = ("WHERE id = {$id}" ?: '');
        $query = "SELECT * FROM " . self::TBL_POSTS . " {$where}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function updateLinePosts(array $dados): void
    {
        $created_at = date('Y-m-d H:i:s');
        $query = "UPDATE " . self::TBL_POSTS . " SET id = $dados[id] , categoria_id = $dados[categoria_id], titulo = '$dados[titulo]', texto = '$dados[textarea]', status = $dados[select_status], created_at = '{$created_at}' WHERE id = $dados[id] ";
        $stmt = Connection::getInstance()->query($query);
        $stmt->execute();
    }
    public function deleteLinePosts(int $id): void
    {
        $query = "DELETE FROM " . self::TBL_POSTS . " WHERE id = $id";
        $stmt = Connection::getInstance()->query($query);
        $stmt->execute();
    }
}
