<?php

namespace App\DB;

use App\Main\Config;

class Connection extends Singleton
{
	private $connection;

	/**
	 * Connection constructor.
	 */
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

	/**
	 * @return \mysqli
	 */
	public function get()
	{
		return $this->connection;
	}

	/**
	 * @param $select
	 *
	 * @return bool|\mysqli_result
	 */
	public function query($select)
	{
		return mysqli_query($this->connection, $select);
	}
}