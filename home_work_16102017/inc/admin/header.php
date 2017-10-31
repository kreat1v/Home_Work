<?php

?><!doctype html>
<html>
<head>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
<div>
    <?php
    if (isset($_SERVER['PHP_AUTH_USER'])) {
        echo "Рады Вас видеть, {$_SERVER['PHP_AUTH_USER']}!";
    }
    ?>
</div>
<ul>
    <li>
        <a href="?page=category">Категории</a>
    </li>
    <li>
        <a href="?page=product">Товары</a>
    </li>
</ul>