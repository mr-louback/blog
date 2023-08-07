<?php

namespace system\Model;

use system\Nucleus\Connection as NucleusConnection;
use system\Nucleus\Model;

class PostModel extends Model
{
    const TBL_POSTS = 'posts';
    public function __construct()
    {
        parent::__construct('posts');
    }
    public function readAllPosts(): array
    {
        $query = "SELECT * FROM " . self::TBL_POSTS ;
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function insertLinePosts(array $dados): void
    {
        $query = "INSERT INTO " . self::TBL_POSTS . "( titulo, texto, status) VALUES ( '$dados[titulo]','$dados[texto]',$dados[status])";
        $stmt = NucleusConnection::getInstance()->prepare($query);
        $stmt->execute();
    }
    public function searchIdPost(int $id): array
    {
        $where = ("WHERE id = {$id}" ?: '');
        $query = "SELECT * FROM " . self::TBL_POSTS . " {$where}";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function updateLinePosts(array $dados): void
    {
        $query = "UPDATE " . self::TBL_POSTS . " SET id = $dados[id] , categoria_id = $dados[categoria_id], titulo = '$dados[titulo]', texto = '$dados[textarea]', status = $dados[select_status] WHERE id = $dados[id] ";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
    }

    public function deleteLinePosts(int $id): void
    {
        $query = "DELETE FROM " . self::TBL_POSTS . " WHERE id = $id";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
    }
}
