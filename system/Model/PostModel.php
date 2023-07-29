<?php

namespace system\Model;

use system\Nucleus\Connection as NucleusConnection;
use system\Nucleus\Helpers;

class PostModel
{
    public function readAllPosts(): array
    {
        $query = "SELECT * FROM posts ";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // var_dump($result);
        return $result;
    }
    public function insertLinePosts(array $dados): void
    {
        $query = "INSERT INTO `posts`( `categoria_id`, `titulo`, `texto`, `status`) VALUES ($dados[categoria_id],'$dados[titulo]','$dados[textarea]',$dados[select_status])";
        $stmt = NucleusConnection::getInstance()->prepare($query);
        $stmt->execute();
    }
    public function searchIdPost(int $id): array
    {
        $query = "SELECT * FROM posts WHERE id = {$id}";
        $stmt = NucleusConnection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        // echo var_dump($result);
        return $result;
    }
    public function updateLinePost(array $dados): void
    {
        $query = "UPDATE posts SET  id = $dados[id], categoria_id = $dados[categoria_id], titulo = '$dados[titulo]', texto = '$dados[textarea]', status = $dados[select_status] WHERE id = $dados[id] ";
        $stmt = NucleusConnection::getInstance()->query($query);
        $stmt->execute();
    }
    // public function searchId(int $id ):bool|object
    // {
    //     $where = ($id ? "WHERE id = {$id}" : '');
    //     $query = "SELECT * FROM posts $where";
    //     $stmt = NucleusConnection::getInstance()->query($query);
    //     $result = $stmt->fetch();
    //     // echo var_dump($result);
    //     return $result;
    // }
    // public function busca(string $busca): array
    // {
    //     $query = "SELECT * FROM posts where status = 1 and titulo like '%{$busca}%'";
    //     $stmt = NucleusConnection::getInstance()->query($query);
    //     $result = $stmt->fetchAll();
    //     // var_dump($result);
    //     return $result;
    // }
    // public function updateLine(string $titulo, string $conteudo, int $id): array
    // {
    //     $query = "UPDATE `posts` SET `titulo` = '$titulo', `texto` = '$conteudo' WHERE `posts`.`id` = $id";
    //     $stmt = NucleusConnection::getInstance()->query($query);
    //     $result = $stmt->fetchAll();
    //     // var_dump($result);
    //     return $result;
    // }
}
