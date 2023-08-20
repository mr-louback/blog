<?php

namespace system\Model;

use system\Nucleus\Connection as NucleusConnection;
use system\Nucleus\Model;

class CategoryModel extends Model
{
    const TBL_CATEGORIES = 'categorias';
    public function __construct()
    {
        $this->table = self::TBL_CATEGORIES;
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
}
