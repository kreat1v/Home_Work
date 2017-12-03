<?php

namespace App\Authorization;

use App\DB\Connection;

class Login
{
	private $connection;

	/**
	 * Login constructor.
	 *
	 * @param Connection $newConnection
	 */
	public function __construct(Connection $newConnection)
	{
		$this->connection = $newConnection;
	}

	/**
	 *
	 * Метод проверки данных авторизации
	 *
	 * @param $login
	 * @param $password
	 *
	 * @return bool
	 */
	public function verification($login, $password)
	{
		$result = $this->connection->query("SELECT password FROM admins WHERE login = $login;");

		$authorization = mysqli_fetch_assoc($result);
		if ($authorization['password'] === $password) {
			return false;
		} else {
			return true;
		}
	}
}