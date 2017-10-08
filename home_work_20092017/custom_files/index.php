<?php
define('DS', DIRECTORY_SEPARATOR);
$files = __DIR__.DS.'files'.DS;
$images = array_diff(scandir($files.'image'), ['.', '..']);

// функция публикации файлов
function fPrintFiles ($files)
{
    $otherFiles = array_values(array_diff(scandir($files), ['.', '..']));
    for ($i = 0; $i < count($otherFiles); $i++) {
        if ($otherFiles[$i] != 'image'){
            $oF[] = array_values(array_diff(scandir($files.DS.$otherFiles[$i]), ['.', '..']));
        }
    }

    $b = [];
    foreach ($oF as $a){
        $b = array_merge($b, $a);
    }

    $i = 1;
    foreach ($b as $c){
        echo $i.". $c<br />";
        $i++;
    }
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Файлы пользователей</h1>
    </header>
    <main>
        <a href="../custom_files/upload.php">Перейдите, чтобы загрузить свои файлы</a>
        <h2>Галерея:</h2>
        <div>
            <?php foreach ($images as $imgPatch): ?>
                <img src="files/image/<?= $imgPatch ?>" alt="pictures"  style="width: 200px; height: 150px;">
            <?php endforeach; ?>
        </div>
        <h2>Остальные файлы:</h2>
        <div>
            <?php
                echo fPrintFiles($files);
            ?>
        </div>
    </main>
</body>
</html>
