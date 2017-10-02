<?php

// манипуляция с куками
$visits_count = isset($_COOKIE['visits_count']) ? (int)$_COOKIE['visits_count'] : 0;
$visits_count++;
if ($visits_count >= 5) {
    setcookie('visits_count', $visits_count, time()+1, '/');
} else {
    setcookie('visits_count', $visits_count, time()+60*60*24, '/');
}

// загрузка файла
$newFile = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $file = $_FILES['file'];
    $type = $file['type'];
    $name = $file['name'];
    if (is_file($file['tmp_name'])){
        move_uploaded_file($file['tmp_name'], __DIR__.DIRECTORY_SEPARATOR.$name);
        $newFile = (__DIR__.DIRECTORY_SEPARATOR.$name);
        header('Content-Disposition: attachment; filename ='.$name);
        header("Content-Type: $type");
        readfile($newFile);
        die();
    }
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Загрузка файла</title>
</head>
<body>
<h1>Загрузи свой файл</h1>
<form action="" enctype="multipart/form-data" method="post">
    <input type="file" name="file" required />
    <button type="submit">Отправить</button>
</form>
</body>
</html>
