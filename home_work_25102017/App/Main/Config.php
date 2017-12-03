<?php

namespace App\Main;

class Config
{
	private static $configuration = [
			'dbHost' => 'localhost',
			'dbUser' => 'goods',
			'dbPassword' => 'goods',
			'dbName' => 'goods',
			'amountOfElements' => 5,
	];

	public static function get($paramName)
	{
		return self::$configuration[$paramName];
	}
}