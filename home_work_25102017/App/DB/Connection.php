<?php

namespace App\DB;

use App\Main\Config;

class Connection extends Singleton
{
	private $connection;

	protected function __construct() {
		$dbHost = Config::get('dbHost');
		$dbUser = Config::get('dbUser');
		$dbPassword = Config::get('dbPassword');
		$dbName = Config::get('dbName');

		$this->connection = mysqli_connect(
			$dbHost,
			$dbUser,
			$dbPassword,
			$dbName
		);
	}

	public function get()
	{
		return $this->connection;
	}

	public function query($select)
	{
		return mysqli_query($this->connection, $select);
	}
}