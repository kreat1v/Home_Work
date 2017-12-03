<?php

// Подключение к БД
$dbHost = 'localhost';
$dbUser = 'goods';
$dbPassword = 'goods';
$dbName = 'goods';

$connection = mysqli_connect(
    $dbHost,
    $dbUser,
    $dbPassword,
    $dbName
);

$tablesMap = [
    'category' => 'category',
    'product' => 'product',
    'admins' => 'admins'
];

// авторизация
function login($login, $password)
{
    global $connection;

    $result = mysqli_query($connection, "SELECT * FROM {$GLOBALS['tablesMap']['admins']};");
    while ($authorization = mysqli_fetch_assoc($result)){
        if ($authorization['login'] === $login && $authorization['password'] === $password) {
            return true;
        }
    }
    return false;
}

// Получение списка
function categoryList($id = null)
{
    return getList($GLOBALS['tablesMap']['category'], $id);
}

function productList($id = null)
{
    return getList($GLOBALS['tablesMap']['product'], $id);
}

function getList($tableName, $id = null)
{
    global $connection;

    $where = '';
    if ($id > 0) {
        $where = ' WHERE id = '.$id;
    }

    $result = mysqli_query($connection, "SELECT * FROM $tableName $where;");
    return $result;
}

// Получение вырезки из списка
function categorySection($limit, $limitStart, $categoryId = null)
{
    return getSection($GLOBALS['tablesMap']['category'], $limit, $limitStart, $categoryId);
}

function productSection($limit, $limitStart, $categoryId = null)
{
    return getSection($GLOBALS['tablesMap']['product'], $limit, $limitStart, $categoryId);
}

function getSection($tableName, $limit, $limitStart, $categoryId = null)
{
    global $connection;

    if ($categoryId > 0) {
        $where = ' WHERE category_id = '.$categoryId;
    }

    $result = mysqli_query($connection, "SELECT * FROM $tableName $where LIMIT $limit OFFSET $limitStart;");
    return $result;
}

// Получение количества
function categoryCount()
{
    return getCount($GLOBALS['tablesMap']['category']);
}

function productCount($categoryId = null)
{
    return getCount($GLOBALS['tablesMap']['product'], $categoryId);
}

function getCount($tableName, $categoryId = null)
{
    global $connection;

    if ($categoryId > 0) {
        $where = ' WHERE category_id = '.$categoryId;
    }

    $result = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) as count FROM $tableName $where;"));
    return $result['count'];
}

// Создание
function createCategory($fields)
{
    return createEntity($GLOBALS['tablesMap']['category'], $fields);
}

function createProduct($fields)
{
    return createEntity($GLOBALS['tablesMap']['product'], $fields);
}

function createEntity($tableName, $data)
{
    global $connection;

    foreach ($data as &$val){
        $values = mysqli_escape_string($connection, $val);
    }

    $cols = implode(',', array_keys($data));
    $values = "'".implode("','", $data)."'";
    return mysqli_query($connection, "INSERT INTO $tableName ($cols) VALUES ($values);");
}

// Обновление
function updateCategory($id, $data)
{
    return updateEntity($GLOBALS['tablesMap']['category'], $id, $data);
}

function updateProduct($id, $data)
{
    return updateEntity($GLOBALS['tablesMap']['product'], $id, $data);
}

function updateEntity($tableName, $id, $data)
{
    global $connection;

    foreach ($data as $key => &$val){
        $val = mysqli_escape_string($connection, $val);
        $values[] = "$key = '$val'";
    }

    $values = implode(',', $values);

    return mysqli_query($connection, "UPDATE $tableName SET $values WHERE id = $id;");
}

// Удаление
function deleteCategory($id)
{
    return deleteEntity($GLOBALS['tablesMap']['category'], $id);
}

function deleteProduct($id)
{
    return deleteEntity($GLOBALS['tablesMap']['product'], $id);
}

function deleteEntity($tableName, $id)
{
    global $connection;

    return mysqli_query($connection, "DELETE FROM $tableName WHERE id = $id;");
}