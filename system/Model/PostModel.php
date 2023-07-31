<?php

namespace system\Model;

use system\Nucleus\Connection as NucleusConnection;
use system\Nucleus\Helpers;

class PostModel
{
    public function readAllPosts(): array
    {
        $query = "SELECT * FROM posts order by id ";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function insertLinePosts(array $dados): void
    {
        $query = "INSERT INTO posts( titulo, texto, status) VALUES ( '$dados[titulo]','$dados[textarea]',$dados[select_status])";
        $stmt = NucleusConnection::getInstance()->prepare($query);
        $stmt->execute();
    }
    public function searchIdPost(int $id): array
    {
        $query = "SELECT * FROM posts WHERE id = {$id}";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function updateLinePosts(array $dados): void
    {

        $query = "UPDATE posts SET id = $dados[id] , categoria_id = $dados[categoria_id], titulo = '$dados[titulo]', texto = '$dados[textarea]', status = $dados[select_status] WHERE id = $dados[id] ";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
    }

    public function deleteLinePosts(int $id): void
    {
        $query = "DELETE FROM posts WHERE id = $id";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
    }
  
}
