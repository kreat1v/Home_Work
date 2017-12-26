<?php

namespace App\Entity;

abstract class Base
{
	/** @var \App\Core\DB\IConnection */
	protected $conn;

	/**
	 * @return mixed
	 */
	abstract function getTableName();

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	abstract function checkFields($data);

	/**
	 * @return mixed
	 */
	abstract function getFields();

	/**
	 * Base constructor.
	 *
	 * @param \App\Core\DB\IConnection $connection
	 */
	public function __construct(\App\Core\DB\IConnection $connection)
	{
		$this->conn = $connection;
	}

	/**
	 * @return mixed
	 */
	public function list()
	{
		$sql = 'SELECT * FROM ' .  $this->getTableName();
		return $this->conn->query($sql);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getById($id)
	{
		$sql = 'SELECT * FROM ' .  $this->getTableName() . ' WHERE id = ' . $this->conn->escape($id) . ' LIMIT 1';
		$result = $this->conn->query($sql);

		return isset($result[0]) ? $result[0] : null;
	}

	/**
	 * @param $data
	 * @param null $id
	 *
	 * @return mixed
	 */
	public function save($data, $id = null)
	{
		$this->checkFields($data);

		$values = [];
		foreach ($data as $key => $val) {
			$this->conn->escape($val);
			if ($id > 0) {
				$values[] = "$key = ?";
			} else {
				$values[] = $val;
			}
		}

		$cols = implode(',', array_keys($data));

		if ($id > 0) {
			$values = implode(',', $values);
			$data[] = $id;
			$sql = "UPDATE " . $this->getTableName() . " SET $values WHERE id = ?";
		} else {
			$vals = rtrim(str_repeat('?,', count($data)), ',');
			$sql = "INSERT INTO " . $this->getTableName() . " ($cols) VALUES ($vals)";
		}

		return $this->conn->query($sql, $data);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function delete($id)
	{
		$sql = 'DELETE * FROM ' .  $this->getTableName() . ' WHERE id = ' . $this->conn->escape($id);
		return $this->conn->query($sql);
	}
}