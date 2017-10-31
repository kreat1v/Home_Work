<?php
define('DS', DIRECTORY_SEPARATOR);

include_once('lib'.DS.'core.php');

if(!login($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])){
    header('WWW-Authenticate: Basic realm="Войдите, что бы увидеть контент!"', false, 401);
    exit('Вы не авторизованы - контент не доступен для вас!');
}

$admin = '';
include_once('index.php');