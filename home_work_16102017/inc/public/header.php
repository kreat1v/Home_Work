<?php

?><!doctype html>
<html>
<head>
    <link rel="stylesheet" href="./style/style.css">
    <title>Магазин</title>
</head>
<body>
<header>

    <div class="hello">
        <?php
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            echo "Рады Вас видеть, {$_SERVER['PHP_AUTH_USER']}!";
        }
        ?>
    </div>

    <nav>
        <ul>
            <li>
                <a href="index.php">Главная</a>
            </li><!--
            --><li>
                <a href="admin.php">Админка</a>
            </li>
        </ul>
    </nav>

</header>
<main>