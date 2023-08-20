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
}
