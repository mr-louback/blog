<?php

namespace system\Model;

use system\Nucleus\Connection;
use system\Nucleus\Helpers;
use system\Nucleus\Model;

class PostModel extends Model
{
    public function __construct()
    {
        $this->table = 'posts';
    }
    public function searchCategoryTitle(int $id): array
    {
        $query = "SELECT titulo FROM categorias WHERE id = {$id}";
        $stmt = Connection::getInstance()->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    // public function searchTitleLike(string $string)
    // {
    //     $query = "SELECT * FROM {$this->table} WHERE titulo LIKE '%$string%'";
    //     $stmt = Connection::getInstance()->query($query);
    //     $result = $stmt->fetchAll();
    //     return $result;
    // }

    /**
     * Summary of inserSlug
     * @param mixed $id
     * @param string $slug
     * @return void
     */
    public function inserSlug(array $slug, ?int $id = null)
    {
        $slugMaked = Helpers::criarSlug($slug['titulo']);
        if ($id !== null) {
            $query = "UPDATE posts SET slug = {$slugMaked} WHERE id = {$id}";
            $stmt = Connection::getInstance()->prepare($query);
            // $stmt->execute();
        }
        $query = "INSERT INTO {$this->table}(slug) VALUES ('{$slugMaked}') ";
        $stmt = Connection::getInstance()->prepare($query);
        var_dump($stmt);
        // $stmt->execute();
    }
    /**
     * Summary of insertCountView
     * @param int $view
     * @return void
     */
    public function updateCountView(int $id, int $view)
    {
        $query = "UPDATE {$this->table} SET views = $view WHERE id = $id";
        $stmt = Connection::getInstance()->prepare($query);
        $stmt->execute();
    }
    
}
