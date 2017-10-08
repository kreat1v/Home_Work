<?php

error_reporting(1);

define('DS', DIRECTORY_SEPARATOR);
// Определим корневую директорию
$base = $_SERVER['DOCUMENT_ROOT'];

// Определяем путь выбранной директории относительно корня
$path = '';
if (!empty($_GET['dir']) && !in_array($_GET['dir'], ['.', '/'])) {
    $path = $_GET['dir'];
}

// Переменные для удаления файлов и директорий
$delete = '';
$del = '';
if (!empty($_GET['del'])) {
    $del = $_GET['del'];
}

// Функция удаления файлов и директорий
function removeDirectory($dir){
    if ($a = glob($dir."/*")) {
        foreach($a as $b) {
            is_dir($b) ? removeDirectory($b) : unlink($b);
        }
    }
    rmdir($dir);
}

// Переменные редактирования
$edit = '';
$edit_filed = '';
$ed = '';
$new_name = '';
if (!empty($_GET['ed'])) {
    $ed = $_GET['ed'];
}

// Получаем все файлы и директории из текущего пути
$files = scandir($base.DS.$path);

// Очищаем от лишних элементов
$removeParts = ['.'];
if (!$path) {
    // Если мы в корне - удаляем элемент родительской директории
    $removeParts[] = '..';
}
$files = array_diff($files, $removeParts);

// Формируем данные для вывода
$result = [];
foreach ($files as $file) {
    $name = $file;
    $absFile = $base.DS.$path.DS.$file;

    // Для директорий делаем имя со ссылкой
    if (is_dir($absFile)) {
        if ($file == '..') {
            // Ссылку "вверх" делаем на один элемент вложенности меньше
            $url = dirname($path);
        } else {
            $url = $path.DS.$name;
            // Удаление директорий
            $delete = "<a href=?dir=$path&del={$name} title='Delete'><i class=\"fa fa-trash\" aria-hidden=\"true\" style='color: black;'></i></a>";
            if ($del == "$name") {
                removeDirectory($absFile);
                header("Refresh: 0;URL=?dir=$path");
            }
            // Редактирование директорий
            $edit = "<a href=?dir=$path&ed={$name} title='Rename'><i class=\"fa fa-pencil\" aria-hidden=\"true\" style='color: gold'></i></i></a>";
            if ($ed == "$name") {
                $edit_filed = "<form method='post'><input type='text' name='edd' value=\"$name\"><button type='submit'>Переименовать</button></form>";
                if (!empty($_POST['edd'])) {
                    $new_name = $_POST['edd'];
                    rename($absFile, $base.DS.$path.DS.$new_name);
                    header("Refresh: 0;URL=?dir=$path");
                }
            } else {
                $edit_filed = '';
            }
        }
        $name = "<a href=?dir={$url}>{$name}</a>";
    } elseif (is_file($absFile)){
        // Удаление файлов
        $delete = "<a href=?dir=$path&del={$name} title='Delete'><i class=\"fa fa-trash\" aria-hidden=\"true\" style='color: black;'></i></a>";
        if ($del == "$name") {
            unlink($absFile);
            header("Refresh: 0;URL=?dir=$path");
        }
        // Редактирование файлов
        $edit = "<a href=?dir=$path&ed={$name} title='Rename'><i class=\"fa fa-pencil\" aria-hidden=\"true\" style='color: gold'></i></i></a>";
        if ($ed == "$name") {
            $edit_filed = "<form method='post'><input type='text' name='edd' value=\"$name\"><button type='submit'>Переименовать</button></form>";
            if (!empty($_POST['edd'])) {
                $new_name = $_POST['edd'];
                rename($absFile, $base.DS.$path.DS.$new_name);
                header("Refresh: 0;URL=?dir=$path");
            }
        } else {
            $edit_filed = '';
        }
    }

    // Добавляем текущий элемент в массив результата
    $result[] = [
        'name' => $name,
        'size' => round(filesize($absFile)/1024, 2) . ' кб',
        'created_at' => date('H:i:s d.m.Y', filectime($absFile)),
        'modification' => date('H:i:s d.m.Y', filemtime($absFile)),
        'delete' => $delete,
        'edit' => $edit,
        'edit_filed' => $edit_filed,
    ];
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/3ad3995b6e.css">
    <title>File Manager</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover" width="100">
                <thead>
                <tr class="bg-warning">
                    <th>Действия</th>
                    <th>Имя файла</th>
                    <th>Размер файла</th>
                    <th>Дата создания</th>
                    <th>Дата изменения</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $file): ?>
                    <tr>
                        <td>
                            <?= $file['delete'] ?>
                            <?= $file['edit'] ?>
                        </td>
                        <td>
                            <?php
                            echo $file['name'];
                            echo '<br>';
                            echo $file['edit_filed'];
                            ?>
                        </td>
                        <td><?= $file['size'] ?></td>
                        <td><?= $file['created_at'] ?></td>
                        <td><?= $file['modification'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>