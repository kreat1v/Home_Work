<?php

namespace App\Entity;

class Page extends Base
{
	public function getTableName()
	{
		return 'pages';
	}

	public function checkFields($data)
	{
		if (!is_string($data['title']) || !strlen($data['title'])) {
			throw new \Exception('Page title can\'t be empty');
		}
	}

	public function getFields()
	{
		return [
			'id',
			'title',
			'alias',
			'content',
			'active'
		];
	}
}