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




