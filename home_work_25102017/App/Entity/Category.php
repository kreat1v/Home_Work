<?php

namespace App\Entity;

class Category extends Base
{
    private $tableName = 'category';

    public function getTableName(): string
    {
        return $this->tableName;
    }

	public function getMap(): array
	{
		$fields = [
			'title' => 'string',
			'description' => 'string',
		];
		return $fields;
	}
}