<?php

namespace App\Entity;

class Product extends Base
{
	private $tableName = 'product';

	public function getTableName(): string
	{
		return $this->tableName;
	}

	public function getMap(): array
	{
		$fields = [
			'title' => 'string',
			'price' => 'integer',
			'description' => 'string',
			'category_id' => 'integer'
		];
		return $fields;
	}
}