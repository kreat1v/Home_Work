<?php

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

function categoryList($id = null)
{
    return getList($GLOBALS['tablesMap']['category'], $id);
}

function productList($id = null, $categoryId = null)
{
    return getList($GLOBALS['tablesMap']['product'], $id, $categoryId);
}

function getList($tableName, $id = null, $categoryId = null, $limit = null, $limitStart = null)
{
    global $connection;

    $condition = '';
    if ($id > 0) {
        $condition = ' WHERE id = '.$id;
    } elseif ($categoryId > 0) {
        $condition = ' WHERE category_id = '.$categoryId;
    } elseif ($limit > 0 && $limitStart > 0){
        $condition = ' LIMIT '.$limit.' OFFSET '.$limitStart;
    }

    $result = mysqli_query($connection, "SELECT * FROM $tableName $condition;");
    return $result;
}

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