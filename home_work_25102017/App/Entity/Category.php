<?php

namespace App\Entity;

class Category extends Base
{
    private $tableName = 'category';

    public function getTableName(): string
    {
        return $this->tableName;
    }
}