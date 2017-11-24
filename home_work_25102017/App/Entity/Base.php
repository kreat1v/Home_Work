<?php

namespace App\Entity;

use App\DB\Connection;

abstract class Base
{
	private $connection;

	public function __construct(Connection $newConnection)
	{
		$this->connection = $newConnection->get();
	}

	/**
     * @return string
     */
    abstract public function getTableName(): string;

    /**
     * Метод должен вовращать поля текущей таблицы (кроме id)
     * в формате:
     * [
     *      'fieldName' => 'fieldType',
     *      'fieldName2' => 'fieldType',
     *      ...
     * ]
     *
     * @return array
     */
//    abstract public function getMap(): array;
    public function getMap()
    {
	    $tableName = $this->getTableName();

	    $result = $this->connection->query("SHOW COLUMNS FROM $tableName;");

	    while ($a = mysqli_fetch_assoc($result)){
		    $arr[$a['Field']] = $a['Type'];
	    }

	    unset($arr['id']);
	    return $arr;
    }

    /**
     * Этот метод вызываем перед каждым обновлением/добавлением,
     * здесь проверяем каждый элемент массива на соответствие типу из массива
     * полученного в getMap, если тип не соответствует - выбрасываем исключение.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
//    abstract protected function checkFields(array $data): bool;
    protected function checkFields(array $data)
    {
		$arr = $this->getMap();

		foreach ($data as $key => $value){
			if ($arr[$key] == gettype($value)) {
				throw new \Exception('Не соответствие типов данных!');
			}
		}

		return true;
    }

    /**
     * В этом методе получаем список элементов таблицы
     * полученной из метода getTableName
     *
     * @param int|null $id
     * @return bool|\mysqli_result
     */
    public function get(int $id = null)
    {
	    $tableName = $this->getTableName();

	    $where = '';
	    if ($id > 0) {
		    $where = ' WHERE id = '.$id;
	    }

	    return mysqli_query($this->connection->getConnection(), "SELECT * FROM $tableName $where;");
	    return $this->connection->query("SELECT * FROM $tableName $where;");
    }

	/**
	 * В этом методе получаем вырезку элементов таблицы
	 *
	 * @param int $limit
	 * @param int $limitStart
	 * @param int|null $categoryId
	 * @return bool|\mysqli_result
	 */
	public function getSection(int $limit, $limitStart, $categoryId = null)
	{
		$tableName = $this->getTableName();

		if ($categoryId > 0) {
			$where = ' WHERE category_id = '.$categoryId;
		}

		return mysqli_query($this->connection->getConnection(), "SELECT * FROM $tableName $where LIMIT $limit OFFSET $limitStart;");
	}

	/**
	 * В этом методе получаем список элементов таблицы
	 * полученной из метода getTableName
	 *
	 * @param int|null $categoryId
	 * @return int
	 */
	public function getCount(int $categoryId = null)
	{
		$tableName = $this->getTableName();

		if ($categoryId > 0) {
			$where = ' WHERE category_id = '.$categoryId;
		}

		$result = mysqli_fetch_assoc(mysqli_query($this->connection->getConnection(), "SELECT COUNT(*) as count FROM $tableName $where;"));
		return $result['count'];
	}

    /**
     * В этом методе создаем новую запись в таблице getTableName.
     * Перед созданием проверяем корректность данных вызовом метода checkFields.
     *
     * @param array $data
     * @return bool|\mysqli_result
     */
    public function create(array $data)
    {
	    $this->checkFields($data);
	    $tableName = $this->getTableName();

    	foreach ($data as &$val){
		    $values = mysqli_escape_string($this->connection->getConnection(), $val);
	    }

	    $cols = implode(',', array_keys($data));
	    $values = "'".implode("','", $data)."'";
	    return mysqli_query($this->connection->getConnection(), "INSERT INTO $tableName ($cols) VALUES ($values);");
    }

    /**
     * В этом методе обновляем запись в таблице getTableName.
     * Перед обновлением проверяем корректность данных вызовом метода checkFields.
     *
     * @param int $id
     * @param array $data
     * @return bool|\mysqli_result
     */
    public function update(int $id, array $data)
    {
	    $this->checkFields($data);
	    $tableName = $this->getTableName();

	    foreach ($data as $key => &$val){
		    $val = mysqli_escape_string($this->connection->getConnection(), $val);
		    $values[] = "$key = '$val'";
	    }

	    $values = implode(',', $values);

	    return mysqli_query($this->connection->getConnection(), "UPDATE $tableName SET $values WHERE id = $id;");
    }

    /**
     * В этом методе удаляем запись в таблице getTableName по id.
     *
     * @param int $id
     * @return bool|\mysqli_result
     */
    public function delete(int $id)
    {
	    $tableName = $this->getTableName();

	    return mysqli_query($this->connection->getConnection(), "DELETE FROM $tableName WHERE id = $id;");
    }
}