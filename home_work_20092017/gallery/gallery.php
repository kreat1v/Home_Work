<?php

define('DS', DIRECTORY_SEPARATOR);

$galleryDir = __DIR__.DS.'gallery_files';

if (!is_dir($galleryDir)) {
    mkdir($galleryDir);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['image'];

    if (file_exists($file['tmp_name'])) {
        if (strcmp(substr($file['type'], 0, 6), 'image/') == 0) {
            move_uploaded_file($file['tmp_name'], $galleryDir.DS.$file['name']);
            echo 'Файл успешно загружен!';
        } else {
            echo 'Вы загружаете не изображение!';
        }
    }
}

$images = array_diff(scandir($galleryDir), ['.', '..']);

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Галерея</title>
</head>
<body>
    <header>
        <h1>Загрузите свои картинки</h1>
    </header>
    <main>
        <div>

            <form action="" enctype="multipart/form-data" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <input type="file" name="image" required />
                <button type="submit">
                    Отправить
                </button>
            </form>

        </div>
        
        <div>
        <?php foreach ($images as $imgPatch): ?>
            <img src="gallery_files/<?= $imgPatch ?>" alt="pictures"  style="width: 200px; height: 150px; padding-top: 20px;">
        <?php endforeach; ?>
        </div>

    </main>
</body>
</html>
