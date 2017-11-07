<?php
define('DS', DIRECTORY_SEPARATOR);

include_once('lib'.DS.'core.php');

if(!login($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])){
    header('WWW-Authenticate: Basic realm="Войдите, что бы увидеть контент!"', false, 401);
    echo 'Вы не авторизованы - контент не доступен для вас!'; ?>
    <a href="index.php">Вернуться на главную страницу.</a>
    <?php
    die();
}

$admin = '';
include_once('index.php');