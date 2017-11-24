<?php

namespace App\Entity;

class Product extends Base
{
	private $tableName = 'product';

	public function getTableName(): string
	{
		return $this->tableName;
	}
}