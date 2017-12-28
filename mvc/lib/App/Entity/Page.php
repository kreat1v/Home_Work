<?php

namespace App\Entity;

class Page extends Base
{
	function getTableName()
	{
		return 'pages';
	}

	function checkFields( $data )
	{
		if (!is_string($data['title']) || !strlen($data['title'])) {
			throw new \Exception('Page title can\'t be empty');
		}
	}

	function getFields()
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